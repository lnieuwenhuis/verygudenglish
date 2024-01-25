<!DOCTYPE html>
<html>
<head>
    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}"/>
    <script src="https://cdn.jsdelivr.net/npm/phaser@3.60.0/dist/phaser-arcade-physics.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/string-similarity@4.0.4/umd/string-similarity.min.js"></script>
    @vite('resources/css/app.css')
</head>
<body  class="bg-blue-900 m-2">

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
        return string.replace(reg, (match) => (map[match]));
    }

    let translationObject = {
        // "network administrator": "netwerkbeheerder",
        // "ICT administrator / IT administrator": "ict-beheerder",
        // "ICT assistant / IT assistant": "ict-medewerker",
        // "application developer": "applicatieontwikkelaar",
        // "visit a company": "een bedrijf bezoeken",
        // "take a seat": "plaatsnemen",
        // "fill in a form / complete a form": "een formulier invullen",
        // "department": "afdeling",
        // "reception desk": "receptiebalie",
        // "foreign visitor/guest": "buitenlandse gast",
        // "folder": "map",
        // "answer questions": "vragen beantwoorden",
        // "make an appointment": "een afspraak maken",
        // "offer help / offer assistance": "hulp aanbieden",
        // "receive visitors": "bezoekers ontvangen",
        // "show somebody the way / show someone the way": "iemand de weg wijzen",
        // "contact somebody": "contact met iemand opnemen",
        // "recognise": "herkennen",
        // "main entrance": "hoofdingang",
        // "invitation": "uitnodiging",
        // "confirm an appointment": "een afspraak bevestigen",
        // "send a confirmation": "een bevestiging sturen",
        // "cancel a meeting": "een vergadering afzeggen",
        // "disassemble / dismantle": "demonteren",
        // "assemble": "monteren",
        // "implement": "implementeren",
        // "testing environment": "testomgeving",
        // "user": "gebruiker",
        // "parts": "onderdelen",
        // "functional design": "functioneel ontwerp",
        // "careful": "voorzichtig",
        // "certainly / sure": "zeker",
        // "invoice / bill": "rekening",
        // "colleague": "collega",
        // "customer / client": "klant",
        // "lately": "de laatste tijd",
        // "for example": "bijvoorbeeld",
        // "instructions": "instructie",
        // "install": "installeren",
        // "unfortunately": "helaas",
        // "perhaps / maybe": "misschien",
        // "polite": "beleefd",
        // "estimation / estimate": "schatting",
        // "employee": "werknemer",
        // "employer": "werkgever",
        // "meanwhile / in the meantime": "ondertussen",
        // "impression": "indruk",
        // "branch": "vestiging",
        // "cancellation": "annulering",
        // "user friendly": "gebruiksvriendelijk",
        // "template": "sjabloon",
        // "working project based": "projectmatig werken",
        // "have access / get access": "toegang krijgen",
        // "urgent": "dringend",
        // "flow chart": "diagram",
        // "attention": "aandacht",
        // "available": "beschikbaar",
        // "compare to": "vergelijken met",
        // "compete": "concurreren",
        // "competitive": "concurrerend",
        // "considerable": "flink",
        // "attachment": "bijlage",
        // "forward": "doorsturen",
        // "content": "inhoud",
        // "table of contents": "inhoudsopgave",
        // "continue": "doorgaan",
        // "contribute to": "bijdragen aan",
        // "guidelines": "richtlijnen",
        // "decide": "beslissen",
        // "operating system": "besturingssysteem",
        // "exchange": "uitwisselen",
        // "demand": "eisen",
        // "depend on": "afhankelijk zijn van",
        // "device": "apparaat",
        // "distance": "afstand",
        // "additional": "aanvullend",
        // "invalid": "ongeldig",
        // "double": "verdubbelen",
        // "solve a problem": "oplossen van een probleem",
        // "usually": "meestal",
        // "the computer froze": "de computer liep vast",
        // "expand": "uitbreiden",
        // "expansion": "uitbreiding",
        // "familiar with": "bekend met",
        // "figures / numbers": "cijfers",
        // "gradually": "langzamerhand",
        // "issue / matter": "kwestie",
        // "objective / goal": "doel",
        // "prepare": "voorbereiden",
        // "profit": "winst",
        // "recover": "herstellen",
        // "recovery": "herstel",
        // "report": "verslag",
        // "screen": "scherm",
        // "security": "veiligheid",
        // "password": "wachtwoord",
        // "select / choose": "kiezen",
        // "present / current": "huidig",
        // "previous": "vorige",
        // "put through": "doorverbinden",
        // "surname": "achternaam",
        // "peripheral devices / peripherals": "randapparatuur",
        // "step-by-step": "stapsgewijs",
        // "general manager": "algemeen directeur",
        // "department manager": "afdelingshoofd",
        // "impolite": "onbeleefd",
        // "registration form": "registratieformulier",
        // "master the English language": "de Engelse taal beheersen",
        // "Dear Sir or Madam": "Geachte heer of mevrouw",
        // "Yours faithfully/sincerely": "Hoogachtend",
        // "Kind regards": "Met vriendelijke groet",
        // "receiver": "ontvanger",
        // "sender": "afzender",
        // "typing error": "typfout",
        // "rude": "onbeschoft",
        // "VAT": "BTW",
        // "automatic signature": "automatische handtekening",
        // "first impression": "eerste indruk",
        // "appearance": "uiterlijk",
        // "client delivery": "klantoplevering",
        // "client meeting": "klantgesprek",
        // "client request/demand": "klantvraag",
        // "resources": "hulpmiddelen",
        // "error notification": "foutmelding",
        // "clean up": "opschonen",
        // "configure": "configureren",
        // "notification form": "meldingsformulier",
        // "switch on / turn on": "aanzetten",
        // "switch off / turn off": "uitzetten",
        // "battery": "accu",
        // "power outlet": "stopcontact",
        // "ink cartridge": "inktpatroon",
        // "power supply": "voeding",
        "complaint": "klacht",
        "complain": "klagen",
        "outdated": "verouderd"
    };

    function getRandomKeyValuePair() { // pak random key & value
        const keysArray = Object.keys(translationObject);
        const randomIndex = Math.floor(Math.random() * keysArray.length);
        const randomKey = keysArray[randomIndex];
        const randomValue = translationObject[randomKey];
        return {
            questionToAnswer: randomKey,
            translation: randomValue
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

                this.load.html("htmlForm", "/storage/html/ageofwords/form.html");
                this.load.image('sky', 'storage/images/meteoor/background.png');
                this.load.image('hearts', 'storage/images/meteoor/Heart.png');
                //this.load.spritesheet('hearts', 'storage/images/meteoor/Heart.png', { frameWidth: 63 , frameHeight: 18 });
                this.load.spritesheet('meteoor', 'storage/images/meteoor/meteoor.png', {
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
                            delete translationObject[randomPair.questionToAnswer];
                            randomPair = getRandomKeyValuePair();
                            this.question.setText(randomPair.questionToAnswer);
                            this.exploding = true;
                            this.meteoor.play('explode');
                            this.meteoor.on(Phaser.Animations.Events.ANIMATION_COMPLETE, function () {
                                this.meteoor.destroy();
                                this.idx--;
                                this.exploding = false;
                            }, this);
                        }
                        name.value = "";
                    }
                });

                document.addEventListener('visibilitychange',  () => {
                    if (document.hidden && !this.isGameOver) {

                        // The tab is hidden, pause your game or take necessary actions
                        this.isGameOver = true;


                    }
                });

            };

            update() {

                if(!this.isGameOver) {
                    //Meteoor opniew inspawnen als hij kapot is
                    if (this.idx < this.maxMeteorsToShow) {
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
                            this.meteoor.play('explode');
                            this.meteoor.on(Phaser.Animations.Events.ANIMATION_COMPLETE, function () {
                                this.meteoor.destroy();
                                this.idx--;
                                this.health--;
                                this.exploding = false;
                                randomPair = getRandomKeyValuePair();
                                this.question.setText(randomPair.questionToAnswer);
                            }, this);

                        }
                    }


                    if (this.health < 3 && this.health > 1) {
                        this.hearts = this.hearts.setCrop(0, 0, 42, 18)
                    }
                    if (this.health < 2 && this.health > 0) {
                        this.hearts = this.hearts.setCrop(0, 0, 21, 18)
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
                gravity: { y: 25 }
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
