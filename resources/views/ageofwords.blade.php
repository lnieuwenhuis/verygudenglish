<!DOCTYPE html>
<html>

<head>
    <script src="https://cdn.jsdelivr.net/npm/phaser@3.60.0/dist/phaser-arcade-physics.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/string-similarity@4.0.4/umd/string-similarity.min.js"></script>
</head>

<body style="overflow: hidden; pointer-events: none">
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
            "network administrator": "netwerkbeheerder",
            "ICT administrator / IT administrator": "ict-beheerder",
            "ICT assistant / IT assistant": "ict-medewerker",
            "application developer": "applicatieontwikkelaar",
            "visit a company": "een bedrijf bezoeken",
            "take a seat": "plaatsnemen",
            "fill in a form / complete a form": "een formulier invullen",
            "department": "afdeling",
            "reception desk": "receptiebalie",
            "foreign visitor/guest": "buitenlandse gast",
            "folder": "map",
            "answer questions": "vragen beantwoorden",
            "make an appointment": "een afspraak maken",
            "offer help / offer assistance": "hulp aanbieden",
            "receive visitors": "bezoekers ontvangen",
            "show somebody the way / show someone the way": "iemand de weg wijzen",
            "contact somebody": "contact met iemand opnemen",
            "recognise": "herkennen",
            "main entrance": "hoofdingang",
            "invitation": "uitnodiging",
            "confirm an appointment": "een afspraak bevestigen",
            "send a confirmation": "een bevestiging sturen",
            "cancel a meeting": "een vergadering afzeggen",
            "disassemble / dismantle": "demonteren",
            "assemble": "monteren",
            "implement": "implementeren",
            "testing environment": "testomgeving",
            "user": "gebruiker",
            "parts": "onderdelen",
            "functional design": "functioneel ontwerp",
            "careful": "voorzichtig",
            "certainly / sure": "zeker",
            "invoice / bill": "rekening",
            "colleague": "collega",
            "customer / client": "klant",
            "lately": "de laatste tijd",
            "for example": "bijvoorbeeld",
            "instructions": "instructie",
            "install": "installeren",
            "unfortunately": "helaas",
            "perhaps / maybe": "misschien",
            "polite": "beleefd",
            "estimation / estimate": "schatting",
            "employee": "werknemer",
            "employer": "werkgever",
            "meanwhile / in the meantime": "ondertussen",
            "impression": "indruk",
            "branch": "vestiging",
            "cancellation": "annulering",
            "user friendly": "gebruiksvriendelijk",
            "template": "sjabloon",
            "working project based": "projectmatig werken",
            "have access / get access": "toegang krijgen",
            "urgent": "dringend",
            "flow chart": "diagram",
            "attention": "aandacht",
            "available": "beschikbaar",
            "compare to": "vergelijken met",
            "compete": "concurreren",
            "competitive": "concurrerend",
            "considerable": "flink",
            "attachment": "bijlage",
            "forward": "doorsturen",
            "content": "inhoud",
            "table of contents": "inhoudsopgave",
            "continue": "doorgaan",
            "contribute to": "bijdragen aan",
            "guidelines": "richtlijnen",
            "decide": "beslissen",
            "operating system": "besturingssysteem",
            "exchange": "uitwisselen",
            "demand": "eisen",
            "depend on": "afhankelijk zijn van",
            "device": "apparaat",
            "distance": "afstand",
            "additional": "aanvullend",
            "invalid": "ongeldig",
            "double": "verdubbelen",
            "solve a problem": "oplossen van een probleem",
            "usually": "meestal",
            "the computer froze": "de computer liep vast",
            "expand": "uitbreiden",
            "expansion": "uitbreiding",
            "familiar with": "bekend met",
            "figures / numbers": "cijfers",
            "gradually": "langzamerhand",
            "issue / matter": "kwestie",
            "objective / goal": "doel",
            "prepare": "voorbereiden",
            "profit": "winst",
            "recover": "herstellen",
            "recovery": "herstel",
            "report": "verslag",
            "screen": "scherm",
            "security": "veiligheid",
            "password": "wachtwoord",
            "select / choose": "kiezen",
            "present / current": "huidig",
            "previous": "vorige",
            "put through": "doorverbinden",
            "surname": "achternaam",
            "peripheral devices / peripherals": "randapparatuur",
            "step-by-step": "stapsgewijs",
            "general manager": "algemeen directeur",
            "department manager": "afdelingshoofd",
            "impolite": "onbeleefd",
            "registration form": "registratieformulier",
            "master the English language": "de Engelse taal beheersen",
            "Dear Sir or Madam": "Geachte heer of mevrouw",
            "Yours faithfully/sincerely": "Hoogachtend",
            "Kind regards": "Met vriendelijke groet",
            "receiver": "ontvanger",
            "sender": "afzender",
            "typing error": "typfout",
            "rude": "onbeschoft",
            "VAT": "BTW",
            "automatic signature": "automatische handtekening",
            "first impression": "eerste indruk",
            "appearance": "uiterlijk",
            "client delivery": "klantoplevering",
            "client meeting": "klantgesprek",
            "client request/demand": "klantvraag",
            "resources": "hulpmiddelen",
            "error notification": "foutmelding",
            "clean up": "opschonen",
            "configure": "configureren",
            "notification form": "meldingsformulier",
            "switch on / turn on": "aanzetten",
            "switch off / turn off": "uitzetten",
            "battery": "accu",
            "power outlet": "stopcontact",
            "ink cartridge": "inktpatroon",
            "power supply": "voeding",
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

        function isObjEmpty (obj) { // check of object leeg is
            return Object.keys(obj).length === 0;
        }

        let randomPair = getRandomKeyValuePair(); // random key & value pakken

        const phaserConfig = {
            type: Phaser.AUTO,
            parent: "game",
            width: 1510,
            height: 455,
            pixelArt: true,
            backgroundColor: '#774F35',
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

        const gameConfig = { // game values
            structureHealth: {
                playerStructure: 1250,
                aiStructure: 1250
            },
            troopDamage: {
                meleeTroop: 50,
                rangedTroop: 25,
                tankTroop: 100
            },
            troopRange: {
                meleeTroop: 20,
                rangedTroop: 40,
                tankTroop: 50
            },
            troopSpeed: {
                meleeTroop: 2,
                rangedTroop: 2,
                tankTroop: 1
            }

        };

        console.log(gameConfig.troopDamage.meleeTroop)

        const game = new Phaser.Game(phaserConfig);

        function preloadScene() { // images & html laden
            this.load.image('background', 'storage/images/ageofwords/background2.png');
            this.load.html("form", "storage/html/ageofwords/form.html");
            this.load.spritesheet('troop', 'storage/images/ageofwords/meleeTroop2.png', { frameWidth: 34, frameHeight: 45, endFrame: 43 });
        }

        function createScene() {
            this.add.image(750, 150, 'background');
            this.nameInput = this.add.dom(755, 428).createFromCache("form");

            const config = {
                key: 'troopAnimation',
                frames: this.anims.generateFrameNumbers('troop', { start: 0, end: 43, first: 0 }),
                frameRate: 43,
                repeat: -1
            };

            this.anims.create(config);

            this.add.sprite(400, 300, 'troop').play('troopAnimation');

            this.question = this.add.text(755, 250, "", {
                color: "#ff0000",
                fontSize: '30px',
                fontStyle: "bold",
            }).setOrigin(0.5, 7);

            this.correct = this.add.text(755, 250, "Correct", {
                color: "#5dff00",
                fontSize: '30px',
                fontStyle: "bold",
            }).setOrigin(0.5, 6);

            this.correct.alpha = 0;

            this.question.setText(randomPair.questionToAnswer);

            this.message = this.add.text(755, 250, "", {
                color: "#FFFFFF",
                fontSize: '30px',
                fontStyle: "bold",
            }).setOrigin(0.5, 8);

            this.timedEvent = new Phaser.Time.TimerEvent({ delay: 4000 });

            const helloButton = this.add.text(975, 410, 'Skip', {fontSize: '35px',  backgroundColor: '#9900ff' , fill: '#FFFFFF' });
            helloButton.setInteractive();
            helloButton.on('pointerdown', () => {
                randomPair = getRandomKeyValuePair();
                this.question.setText(randomPair.questionToAnswer);
            }, this);

            this.returnKey = this.input.keyboard.addKey(Phaser.Input.Keyboard.KeyCodes.ENTER);

            this.returnKey.on("down", event => { // als enter word ingedrukt
                let name = this.nameInput.getChildByName("name");
                if (name.value !== "") {
                    this.message.setText(sanitize(name.value));
                    var similarity = stringSimilarity.compareTwoStrings(randomPair.translation,name.value.toLowerCase());
                    if (similarity > 0.98) {
                        this.correct.alpha = 100;
                        this.time.addEvent(this.timedEvent);
                        delete translationObject[randomPair.questionToAnswer];
                        randomPair = getRandomKeyValuePair();
                        this.question.setText(randomPair.questionToAnswer);
                    }
                    name.value = "";
                }
            });
        }

        function updateScene() {
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
    </script>

</body>

</html>
