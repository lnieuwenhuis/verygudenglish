<!DOCTYPE html>
<html>

<head>
    <script src="https://cdn.jsdelivr.net/npm/phaser@3.60.0/dist/phaser-arcade-physics.min.js"></script>
</head>

<body style="overflow: hidden">
    <script>
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
            return string.replace(reg, (match)=>(map[match]));
        }

        let translationObject = {
            "Yes": "ja",
            "No": "nee",
            "Thanks": "bedankt"
        };

        function getRandomKeyValuePair() {
            const keysArray = Object.keys(translationObject);
            const randomIndex = Math.floor(Math.random() * keysArray.length);
            const randomKey = keysArray[randomIndex];
            const randomValue = translationObject[randomKey];
            return {
                questionToAnswer: randomKey,
                translation: randomValue
            };
        }

        function isObjEmpty (obj) {
            return Object.keys(obj).length === 0;
        }

        let randomPair = getRandomKeyValuePair();
        const phaserConfig = {
            type: Phaser.AUTO,
            parent: "game",
            width: 1280,
            height: 400,
            dom: {
                createContainer: true,
            },
            scale: {
                mode: Phaser.Scale.FIT,
           },
            scene: {
                preload: preloadScene,
                create: createScene,
                update: updateScene
            }
        };

        const game = new Phaser.Game(phaserConfig);


        function preloadScene() {
            this.load.image('background', 'storage/images/ageofwords/background.png');
            this.load.html("form", "storage/html/ageofwords/form.html");
        }
        function createScene() {
            this.add.image(500, 300, 'background');
            this.nameInput = this.add.dom(640, 360).createFromCache("form");

            this.question = this.add.text(640, 250, "", {
                color: "#ff0000",
                fontSize: '30px',
                fontStyle: "bold",
            }).setOrigin(0.5, 7);

            this.correct = this.add.text(640, 250, "Correct", {
                color: "#5dff00",
                fontSize: '30px',
                fontStyle: "bold",
            }).setOrigin(0.5, 6);

            this.correct.alpha = 0;

            this.question.setText(randomPair.questionToAnswer);

            this.message = this.add.text(640, 250, "", {
                color: "#FFFFFF",
                fontSize: '30px',
                fontStyle: "bold",
            }).setOrigin(0.5, 8);
            const helloButton = this.add.text(860, 340, 'Skip', {fontSize: '35px', backgroundColor: '#9900ff' , fill: '#FFFFFF' });
            helloButton.setInteractive();
            helloButton.on('pointerdown', () => {
                randomPair = getRandomKeyValuePair();
                this.question.setText(randomPair.questionToAnswer);
            }, this);

            this.returnKey = this.input.keyboard.addKey(Phaser.Input.Keyboard.KeyCodes.ENTER);

            this.returnKey.on("down", event => {
                let name = this.nameInput.getChildByName("name");
                if(name.value != "") {
                    this.message.setText(sanitize(name.value));
                    if (randomPair.translation === name.value.toLowerCase()) {
                        this.correct.alpha = 100;
                        delete translationObject[randomPair.questionToAnswer];
                        console.log([translationObject])
                        randomPair = getRandomKeyValuePair();
                        this.question.setText(randomPair.questionToAnswer);
                    } else {
                        this.correct.alpha = 0;
                    }
                    name.value = "";
                }
            });

        }
        function updateScene() { }

    </script>

</body>

</html>
