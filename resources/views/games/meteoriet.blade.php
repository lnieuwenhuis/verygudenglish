<!DOCTYPE html>
<html>
<head>
    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}"/>
    <script src="https://cdn.jsdelivr.net/npm/phaser@3.60.0/dist/phaser-arcade-physics.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/string-similarity@4.0.4/umd/string-similarity.min.js"></script>
    <meta name="_token" content="{{ csrf_token() }}">
    @vite('resources/css/app.css')
</head>
<body  class="bg-blue-900 m-2">

<script>
    // async function getWordlist() {
    //     const response = await fetch("http://127.0.0.1:8000/api/products");
    //     const words = await response.json();
    //     return words.products;
    // }


    function sanitize(string) {
        const map = {
            '&': '',
            '<': '',
            '>': '',
            '"': '',
            "'": '',
            "/": '',
        };
        const reg = /[&<>"'/]/ig;
        return string.replace(reg, (match) => (map[match]));
    }

    let translationObject = {!! $words->toJson() !!};

    function getRandomKeyValuePair() { // pak random key & value
        if(translationObject.length === 0) return null

        const keysArray = Object.keys(translationObject);
        const randomIndex = Math.floor(Math.random() * keysArray.length);
        const randomKey = keysArray[randomIndex];
        const question = translationObject[randomKey].words;
        const answer = translationObject[randomKey].answers;

        return {
            key: randomKey,
            questionToAnswer: question,
            translation: answer
        };
    }


    function getRandomInt(min, max) {
        min = Math.ceil(min);
        max = Math.floor(max);
        return Math.floor(Math.random() * (max - min) + min);
    }

    function isObjEmpty(obj) { // check of object leeg is
        return Object.keys(obj).length === 0;
    }

    let randomPair = getRandomKeyValuePair(); // random key & value pakken



        class Example extends Phaser.Scene {


            preload() {

                // fetch("http://127.0.0.1:8000/api/products").then(res => {
                //     res.json().then(data => {
                //         translationObject = data.products
                //     })
                // });
                this.load.html("htmlForm", "../storage/html/ageofwords/form.html");
                this.load.image('sky', '../storage/images/meteoor/background.png');
                this.load.image('hearts', '../storage/images/meteoor/Heart.png');
                //this.load.spritesheet('hearts', 'storage/images/meteoor/Heart.png', { frameWidth: 63 , frameHeight: 18 });
                this.load.spritesheet('meteoor', '../storage/images/meteoor/meteoor.png', {
                    frameWidth: 75,
                    frameHeight: 76
                });
                //this.load.image('green', 'assets/particles/green.png');
            }


            create() {



                this.add.image(750, 370, 'sky');
                    this.hearts = this.add.image(1350, 50, 'hearts');
                    this.hearts.setScale(3);
                    this.nameInput = this.add.dom(755, 700).createFromCache("htmlForm");
                    this.maxMeteorsToShow = 1;
                    this.idx = 0;
                    this.health = 3;
                    this.lastUpdateMoment = 0;
                    this.forcedUpdateMoment = 0;
                    this.isRunningUpdateFirstTime = true;
                    this.isGameOver = false;
                    this.pointer = false;
                    this.exploding = false;
                    this.hasSent = false;
                    this.won = false;
                    this.fails = 0;

                    // const particles = this.add.particles(0, 0, 'green', {
                    //     speed: 500,
                    //     scale: { start: 0.4, end: 5 },
                    //     blendMode: 'ADD'
                    // });
                    //
                    // animatie aanmaken
                    this.anims.create({
                        key: 'explode',
                        frames: this.anims.generateFrameNumbers('meteoor', {frames: [0, 1, 2, 3, 4, 5, 6]}),
                        frameRate: 10,
                        repeat: 0,
                    });
                this.question = this.add.text(755, 250, "", {
                    color: "#ff0000",
                    fontSize: '30px',
                    fontStyle: "bold",
                }).setOrigin(0.5, 7);

                this.question.setText(randomPair.questionToAnswer);
                this.question.depth = 1
                this.question.alpha = 100;


                this.spelling = this.add.text(670, 510, "Let op je spelling!!!", {
                    color: "#ffffff",
                    fontSize: '20px',
                    fontStyle: "bold",
                }).setOrigin(0.5, 7);

                this.correct = this.add.text(755, 250, "Correct", {
                    color: "#5dff00",
                    fontSize: '30px',
                    fontStyle: "bold",
                }).setOrigin(0.5, 6);

                this.correct.alpha = 0;

                this.gameOverText = this.add.text(200, 200, "Game Over", {
                    color: "#ffffff",
                    fontSize: '200px',
                    fontStyle: "bold",
                })
                this.victoryText = this.add.text(200, 200,  "Victory!", {
                    color: "#ffffff",
                    fontSize: '200px',
                    fontStyle: "bold",
                })
                this.tryAgain = this.add.text(150, 450, "Click anywhere on the screen to try again", {
                    color: "#ffffff",
                    fontSize: '50px',
                    fontStyle: "bold",
                })

                this.message = this.add.text(755, 250, "", {
                    color: "#FFFFFF",
                    fontSize: '30px',
                    fontStyle: "bold",
                }).setOrigin(0.5, 8);

                this.timedEvent = new Phaser.Time.TimerEvent({
                    delay: 4000
                });

                this.gameOverText.alpha = 0;
                this.victoryText.alpha = 0;
                this.victoryText.depth = 1
                this.tryAgain.alpha = 0;





                this.returnKey = this.input.keyboard.addKey(Phaser.Input.Keyboard.KeyCodes.ENTER);

                this.returnKey.on("down", event => { // als enter word ingedrukt
                    let name = this.nameInput.getChildByName("name");
                    if (name.value !== "") {
                        this.spelling.alpha = 0;
                        this.message.setText(sanitize(name.value));
                        var similarity = stringSimilarity.compareTwoStrings(randomPair.translation, name.value
                            .toLowerCase());
                        if (similarity > 0.98) {
                            this.correct.alpha = 100;
                            this.time.addEvent(this.timedEvent);


                            translationObject.splice(randomPair.key, 1)


                            this.question.setText(randomPair.questionToAnswer);
                            this.exploding = true;
                            this.meteoor.play('explode');
                            this.question.alpha = 0;

                            this.meteoor.on(Phaser.Animations.Events.ANIMATION_COMPLETE, function () {
                                this.meteoor.destroy();
                                this.idx--;
                                this.exploding = false;
                                this.question.alpha = 100;
                                randomPair = getRandomKeyValuePair();
                                if(randomPair == null){
                                    this.victoryText.alpha = 100;
                                    this.won = true;
                                    this.question.alpha = 0;
                                    return
                                }
                                this.question.setText(randomPair.questionToAnswer);
                            }, this);
                        }
                        name.value = "";
                    }
                });

                document.addEventListener('visibilitychange',  () => {
                    if (document.hidden && !this.isGameOver && translationObject.length > 0) {

                        // The tab is hidden, pause your game or take necessary actions
                        this.isGameOver = true;


                    }
                });

            };

            update() {
{{--                {{    dd($period_id )}};--}}

                if(this.won && !this.hasSent){
                    fetch("{!! route('resultaten.store') !!}", {
                        method: "POST",
                        body: JSON.stringify({
                            userId: 1,
                            title: "result",
                            period_id: {{ $period_id->id }},
                            wordlist_id: {{ $list_id->id }},
                            student_id: "1",
                            result: this.fails,
                            completed: false
                        }),
                        headers: {
                            "X-CSRF-Token": document.querySelector('meta[name="_token"]').content,
                            "Content-type": "application/json; charset=UTF-8"
                        }
                    }).then(function (response) {
                        if (response.status !== 200) {
                            alert('asdfkjlasdf');
                        }
                    });

                    this.hasSent = true


                }

                if(!this.isGameOver) {
                    //Meteoor opniew inspawnen als hij kapot is
                    if (this.idx < this.maxMeteorsToShow && translationObject.length > 0) {
                        const x = Phaser.Math.Between(1500, config.width - 1500);

                        this.meteoor = this.physics.add.sprite(x, 1, 'meteoor');
                        this.meteoor.setScale(7);
                        this.meteoor.setSize(50, 40, true);



                        // particles.startFollow(logo);
                        //meteoor.setVelocity(100, 200);
                        //meteoor.setBounce(1,1);
                        this.meteoor.setCollideWorldBounds(true);
                        this.idx++;
                    }
                    this.question.x = this.meteoor.x
                    this.question.y = this.meteoor.y +190

                    if (!this.exploding) {
                        if (this.meteoor.y >= 650) {
                            this.exploding = true;
                            this.question.alpha = 0;
                            this.meteoor.play('explode');
                            this.meteoor.on(Phaser.Animations.Events.ANIMATION_COMPLETE, function () {
                                this.meteoor.destroy();
                                this.idx--;
                                this.health--;
                                this.exploding = false;
                                this.question.alpha = 100;
                                randomPair = getRandomKeyValuePair();
                                this.question.setText(randomPair.questionToAnswer);
                            }, this);

                        }
                    }


                    if (this.health < 3 && this.health > 1) {
                        this.hearts = this.hearts.setCrop(0, 0, 42, 18)
                        this.fails = 1;
                    }
                    if (this.health < 2 && this.health > 0) {
                        this.hearts = this.hearts.setCrop(0, 0, 21, 18)
                        this.fails = 2;
                    }
                    if (this.health < 1) {
                        this.hearts.destroy();
                        this.isGameOver = true;
                    }

                } else {

                    if (!this.pointer){
                        this.input.on('pointerdown', () => this.scene.restart())
                        this.gameOverText.alpha = 100;
                        this.tryAgain.alpha = 100;
                        this.meteoor.destroy();
                        this.pointer = true;
                        this.question.alpha = 0;
                    }
                }
                const progress = this.timedEvent.getProgress();

                if (progress >= 0.5 && this.correct.alpha > 0) {
                    const decreaseStep = () => {
                        if (this.correct.alpha > 0) {
                            this.correct.alpha -= 0.1;

                            setTimeout(decreaseStep, 100);
                        } else {
                            this.correct.alpha = 0;
                        }
                    };
                    decreaseStep();
                }
            }


    }

    const config = {
        type: Phaser.AUTO,
        width: 1500,
        height: 800,
        scene: Example,
        autoPause: false,
        autoCenter: Phaser.Scale.CENTER_BOTH,
        parent: "game",
        physics: {
            default: 'arcade',
            arcade: {
                gravity: { y: 5 }
            }
        },
        dom: {
            createContainer: true,
        },
        scale: {
            mode: Phaser.Scale.FIT,
        },
    };



    const game = new Phaser.Game(config);
</script>

</body>
</html>
