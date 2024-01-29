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
        return string.replace(reg, (match) => (map[match]));
    }
    let translationObject = {
       "a": "a",
       "k": "k",
    };

    // let translationObject = {
    //     "network administrator": "netwerkbeheerder",
    //     "ICT administrator / IT administrator": "ict-beheerder",
    //     "ICT assistant / IT assistant": "ict-medewerker",
    //     "application developer": "applicatieontwikkelaar",
    //     "visit a company": "een bedrijf bezoeken",
    //     "take a seat": "plaatsnemen",
    //     "fill in a form / complete a form": "een formulier invullen",
    //     "department": "afdeling",
    //     "reception desk": "receptiebalie",
    //     "foreign visitor/guest": "buitenlandse gast",
    //     "folder": "map",
    //     "answer questions": "vragen beantwoorden",
    //     "make an appointment": "een afspraak maken",
    //     "offer help / offer assistance": "hulp aanbieden",
    //     "receive visitors": "bezoekers ontvangen",
    //     "show somebody the way / show someone the way": "iemand de weg wijzen",
    //     "contact somebody": "contact met iemand opnemen",
    //     "recognise": "herkennen",
    //     "main entrance": "hoofdingang",
    //     "invitation": "uitnodiging",
    //     "confirm an appointment": "een afspraak bevestigen",
    //     "send a confirmation": "een bevestiging sturen",
    //     "cancel a meeting": "een vergadering afzeggen",
    //     "disassemble / dismantle": "demonteren",
    //     "assemble": "monteren",
    //     "implement": "implementeren",
    //     "testing environment": "testomgeving",
    //     "user": "gebruiker",
    //     "parts": "onderdelen",
    //     "functional design": "functioneel ontwerp",
    //     "careful": "voorzichtig",
    //     "certainly / sure": "zeker",
    //     "invoice / bill": "rekening",
    //     "colleague": "collega",
    //     "customer / client": "klant",
    //     "lately": "de laatste tijd",
    //     "for example": "bijvoorbeeld",
    //     "instructions": "instructie",
    //     "install": "installeren",
    //     "unfortunately": "helaas",
    //     "perhaps / maybe": "misschien",
    //     "polite": "beleefd",
    //     "estimation / estimate": "schatting",
    //     "employee": "werknemer",
    //     "employer": "werkgever",
    //     "meanwhile / in the meantime": "ondertussen",
    //     "impression": "indruk",
    //     "branch": "vestiging",
    //     "cancellation": "annulering",
    //     "user friendly": "gebruiksvriendelijk",
    //     "template": "sjabloon",
    //     "working project based": "projectmatig werken",
    //     "have access / get access": "toegang krijgen",
    //     "urgent": "dringend",
    //     "flow chart": "diagram",
    //     "attention": "aandacht",
    //     "available": "beschikbaar",
    //     "compare to": "vergelijken met",
    //     "compete": "concurreren",
    //     "competitive": "concurrerend",
    //     "considerable": "flink",
    //     "attachment": "bijlage",
    //     "forward": "doorsturen",
    //     "content": "inhoud",
    //     "table of contents": "inhoudsopgave",
    //     "continue": "doorgaan",
    //     "contribute to": "bijdragen aan",
    //     "guidelines": "richtlijnen",
    //     "decide": "beslissen",
    //     "operating system": "besturingssysteem",
    //     "exchange": "uitwisselen",
    //     "demand": "eisen",
    //     "depend on": "afhankelijk zijn van",
    //     "device": "apparaat",
    //     "distance": "afstand",
    //     "additional": "aanvullend",
    //     "invalid": "ongeldig",
    //     "double": "verdubbelen",
    //     "solve a problem": "oplossen van een probleem",
    //     "usually": "meestal",
    //     "the computer froze": "de computer liep vast",
    //     "expand": "uitbreiden",
    //     "expansion": "uitbreiding",
    //     "familiar with": "bekend met",
    //     "figures / numbers": "cijfers",
    //     "gradually": "langzamerhand",
    //     "issue / matter": "kwestie",
    //     "objective / goal": "doel",
    //     "prepare": "voorbereiden",
    //     "profit": "winst",
    //     "recover": "herstellen",
    //     "recovery": "herstel",
    //     "report": "verslag",
    //     "screen": "scherm",
    //     "security": "veiligheid",
    //     "password": "wachtwoord",
    //     "select / choose": "kiezen",
    //     "present / current": "huidig",
    //     "previous": "vorige",
    //     "put through": "doorverbinden",
    //     "surname": "achternaam",
    //     "peripheral devices / peripherals": "randapparatuur",
    //     "step-by-step": "stapsgewijs",
    //     "general manager": "algemeen directeur",
    //     "department manager": "afdelingshoofd",
    //     "impolite": "onbeleefd",
    //     "registration form": "registratieformulier",
    //     "master the English language": "de Engelse taal beheersen",
    //     "Dear Sir or Madam": "Geachte heer of mevrouw",
    //     "Yours faithfully/sincerely": "Hoogachtend",
    //     "Kind regards": "Met vriendelijke groet",
    //     "receiver": "ontvanger",
    //     "sender": "afzender",
    //     "typing error": "typfout",
    //     "rude": "onbeschoft",
    //     "VAT": "BTW",
    //     "automatic signature": "automatische handtekening",
    //     "first impression": "eerste indruk",
    //     "appearance": "uiterlijk",
    //     "client delivery": "klantoplevering",
    //     "client meeting": "klantgesprek",
    //     "client request/demand": "klantvraag",
    //     "resources": "hulpmiddelen",
    //     "error notification": "foutmelding",
    //     "clean up": "opschonen",
    //     "configure": "configureren",
    //     "notification form": "meldingsformulier",
    //     "switch on / turn on": "aanzetten",
    //     "switch off / turn off": "uitzetten",
    //     "battery": "accu",
    //     "power outlet": "stopcontact",
    //     "ink cartridge": "inktpatroon",
    //     "power supply": "voeding",
    //     "complaint": "klacht",
    //     "complain": "klagen",
    //     "outdated": "verouderd"
    // };

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

    class PlayerTroopGameObject extends Phaser.Physics.Arcade.Sprite {
        constructor(scene, x, y, troopType, group) {
            super(scene, x, y, troopType, group);
            this.health = 100;
            this.isEnemy = group;

            this.movementSpeed = 0
            this.units = this.scene.unitTroopGroup
            if (!this.isEnemy) {
                this.movementSpeed = 40
                this.health += 20;
            } else {
                this.movementSpeed = -40
                this.flipX = true;
            }
            this.playerNewAnimation = true;
            this.attacking = false;
            this.isColliding = false;

            this.setScale(0.35);
            this.troopType = troopType;
            this.deathAnimationKey = troopType + 'DeathAnimation';
            if (this.deathAnimationKey === 'tankTroopDeathAnimation') {
                this.setScale(0.6);
            }

            scene.physics.add.existing(this);

            scene.physics.world.enable(this);

            this.setCollideWorldBounds(true);

            scene.add.existing(this);

            this.isCollidingUnit = false;

            this.setupColliders();
        }

        update() {
            if (this.attacking && this.troopType === "meleeTroop") {
                this.setScale(0.45);
            } else {
                if (this.troopType === "meleeTroop") {
                    this.setScale(0.35);
                }
            }
            if (!this.isDead() && !this.isCollidingUnit) {
                this.setVelocityX(this.movementSpeed);
                if (this.playerNewAnimation) {
                    this.playerNewAnimation = false;
                    this.play(this.troopType + 'Animation');
                }
            }

            if (this.isDead()) {
                this.handleDeadTroop(this);
            }

            if (!this.isDead() && this.attacking) {
                console.log(this.health)
                if (this.playerNewAnimation) {
                    this.playerNewAnimation = false;
                    this.play(this.troopType + 'AttackAnimation');
                }
            }
        }

        setupColliders() {
            this.overlap = this.scene.physics.add.overlap(this.units,this.units,this.handleUnitCollision, null, this)
        }

        handleUnitCollision(me, other) {
            if (!me.isDead() && !me.isCollidingUnit && !other.isDead()) {
                me.setPushable(false);
                me.setVelocityX(0);
                me.isCollidingUnit = true;

                if ((me.isEnemy && other.isEnemy) || ((!me.isEnemy  && !other.isEnemy))) {
                    me.attacking = false;
                } else {
                    me.attacking = true;
                    me.playerNewAnimation = true;
                    me.once('animationcomplete', () => {
                        console.log(me.attackDamage)
                        other.health -= getRandomInt(me.attackDamage - 10, me.attackDamage);
                        me.playerNewAnimation = true;
                        me.isCollidingUnit = false;
                        me.attacking = false;
                    });
                }
                me.play(me.troopType + 'IdleAnimation');
            }

        }


        handleDeadTroop(player) {
            if (!player.deathAnimation) {
                player.attacking = false;
                player.deathAnimation = true;
                player.play(player.deathAnimationKey);
                player.once('animationcomplete', () => {
                    this.units.getChildren().forEach(child => {
                        child.isCollidingUnit = false;
                    })
                    setTimeout(() => {
                        player.destroy();
                    }, 2000);
                });
            }
        }


        isDead() {
            return this.health <= 0;
        }
    }

    let troopsInQueue = 0;

    const phaserConfig = {
        type: Phaser.AUTO,
        parent: "game",
        width: 1510,
        height: 455,
        backgroundColor: '#774F35',
        antialias: true,
        physics: {
            default: 'arcade',
            arcade: {
                gravity: {
                    y: 300
                },
                debug: true
            }
        },
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
        },
        queueTime: {
            meleeTroop: 2,
            rangedTroop: 2,
            tankTroop: 3
        },
        coins: {
            player: 2000,
            enemy: 400
        },
        troopsInQueue: {
            player: 0,
            enemy: 0
        }
    };

    const game = new Phaser.Game(phaserConfig);
    let rectangles = [];
    let additive = 300

    function preloadScene() { // images & html laden
        this.load.html("htmlForm", "storage/html/ageofwords/form.html");
        this.load.image('background', 'storage/images/ageofwords/shapes/background/background3.png');
        this.load.image('cave', 'storage/images/ageofwords/shapes/building/cave.png');
        this.load.image('coins', 'storage/images/ageofwords/shapes/money/coins.png');
        this.load.image('meleeTroopBuy', 'storage/images/ageofwords/buttons/meleeTroop.png');
        this.load.image('rangedTroopBuy', 'storage/images/ageofwords/buttons/rangedTroop.png');
        this.load.image('tankTroopBuy', 'storage/images/ageofwords/buttons/tankTroop.png');
        this.load.spritesheet('meleeTroop', 'storage/images/ageofwords/sprites/troops/meleeTroop.png', { frameWidth: 137, frameHeight: 180, endFrame: 43 });
        this.load.spritesheet('meleeTroopIdle', 'storage/images/ageofwords/sprites/troops/idle/meleeTroop.png', { frameWidth: 97, frameHeight: 174, endFrame: 50 });
        this.load.spritesheet('meleeTroopDeath', 'storage/images/ageofwords/sprites/troops/death/meleeDeath.png', { frameWidth: 225, frameHeight: 180, endFrame: 24 });
        this.load.spritesheet('meleeTroopAttack', 'storage/images/ageofwords/sprites/troops/attack/meleeTroop.png', { frameWidth: 170, frameHeight: 175, endFrame: 40 });
        this.load.spritesheet('rangedTroop', 'storage/images/ageofwords/sprites/troops/rangedTroop.png', { frameWidth: 84, frameHeight: 135, endFrame: 43 });
        this.load.spritesheet('rangedTroopDeath', 'storage/images/ageofwords/sprites/troops/death/rangedDeath.png', { frameWidth: 163, frameHeight: 162, endFrame: 24 });
        this.load.spritesheet('tankTroop', 'storage/images/ageofwords/sprites/troops/tankTroop.png', { frameWidth: 180, frameHeight: 133, endFrame: 40 });
        this.load.spritesheet('tankTroopIdle', 'storage/images/ageofwords/sprites/troops/idle/tankTroop.png', { frameWidth: 178, frameHeight: 131, endFrame: 48 });
        this.load.spritesheet('tankTroopDeath', 'storage/images/ageofwords/sprites/troops/death/tankDeath.png', { frameWidth: 280, frameHeight: 148, endFrame: 50 });
        this.load.spritesheet('tankTroopAttack', 'storage/images/ageofwords/sprites/troops/attack/tankAttack.png', { frameWidth: 218, frameHeight: 134, endFrame: 45 });
    }

    function createScene() {
        this.add.image(750, 150, 'background');
        this.nameInput = this.add.dom(755, 428).createFromCache("htmlForm");
        this.physics.world.setBounds(32, 115, 1500, 240);

        const troopConfigurations = [
            {key: 'meleeTroop', frameRate: 43, frameNumbers: {start: 0, end: 42, first: 0}, repeat: -1},
            {key: 'meleeTroopIdle', frameRate: 43, frameNumbers: {start: 0, end: 50, first: 0}, repeat: -1},
            {key: 'meleeTroopDeath', frameRate: 43, frameNumbers: {start: 0, end: 23, first: 0}, repeat: 0},
            {key: 'meleeTroopAttack', frameRate: 43, frameNumbers: {start: 0, end: 40, first: 0}, repeat: 0},

            {key: 'rangedTroop', frameRate: 43, frameNumbers: {start: 0, end: 43, first: 0}, repeat: -1},
            {key: 'rangedTroopDeath', frameRate: 43, frameNumbers: {start: 0, end: 23, first: 0}, repeat: 0},

            {key: 'tankTroop', frameRate: 43, frameNumbers: {start: 0, end: 40, first: 0}, repeat: -1},
            {key: 'tankTroopIdle', frameRate: 43, frameNumbers: {start: 0, end: 48, first: 0}, repeat: -1},
            {key: 'tankTroopAttack', frameRate: 44, frameNumbers: {start: 0, end: 45, first: 0}, repeat: 0},
            {key: 'tankTroopDeath', frameRate: 43, frameNumbers: {start: 0, end: 49, first: 0}, repeat: 0},
        ];

        for (const {
            key,
            frameRate,
            frameNumbers,
            repeat
        }
            of troopConfigurations) {
            this.anims.create({
                key: key + 'Animation',
                frames: this.anims.generateFrameNumbers(key, frameNumbers),
                frameRate,
                repeat: repeat

            });
        }

        this.playerCave = this.add.image(50, 270, 'cave').setScale(0.4);

        this.enemyCave = this.add.image(1450, 270, 'cave').setScale(0.4).setFlipX(true);

        this.unitTroopGroup = this.physics.add.group({
            defaultKey: 'unitTroop',
            maxSize: -1,
            runChildUpdate: true,
            collideWorldBounds: true
        });

        this.troops = [];
        this.Enemytroops = [];

        this.spelling = this.add.text(670, 510, "Let op je spelling!!!", {
            color: "#ffffff",
            fontSize: '20px',
            fontStyle: "bold",
        }).setOrigin(0.5, 7);

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

        this.add.image(1000, 50, "coins")

        this.money = this.add.text(1020, 45, gameConfig.coins.player, {
            color: "#ffea00",
            fontSize: '20px',
            fontStyle: "bold",
        })

        this.correct.alpha = 0;

        this.question.setText(randomPair.questionToAnswer);

        this.message = this.add.text(755, 250, "", {
            color: "#FFFFFF",
            fontSize: '30px',
            fontStyle: "bold",
        }).setOrigin(0.5, 8);

        this.timedEvent = new Phaser.Time.TimerEvent({
            delay: 4000
        });

        this.timedEventProgressBar = new Phaser.Time.TimerEvent({
            delay: 3000
        });

        const skipButton = this.add.text(975, 410, 'Skip', {
            fontSize: '35px',
            backgroundColor: '#9900ff',
            fill: '#FFFFFF'
        });
        skipButton.setInteractive();
        skipButton.on('pointerdown', () => {
            randomPair = getRandomKeyValuePair();
            this.question.setText(randomPair.questionToAnswer);
        }, this);

        const meleeBuyButton = this.add.image(1300, 50, 'meleeTroopBuy').setInteractive();
        meleeBuyButton.on('pointerdown', () => {
            console.log(gameConfig.coins.player);

            if (gameConfig.coins.player >= 25) {
                console.log(gameConfig.troopsInQueue.player);

                if (gameConfig.troopsInQueue.player < 5) {
                    gameConfig.coins.player -= 25;
                    gameConfig.troopsInQueue.player += 1;
                    this.time.addEvent(this.timedEventProgressBar);

                    const delay = gameConfig.troopsInQueue.player * 3000;

                    setTimeout(() => {
                        const troop = new PlayerTroopGameObject(this, 110, 320, 'meleeTroop', false);
                        troop.deathAnimation = false;
                        troop.attackDamage = 20;
                        this.unitTroopGroup.add(troop);
                        gameConfig.troopsInQueue.player -= 1;
                        this.progressFill.width = 0;
                    }, delay);
                }
            }
        }, this);

        const rangedBuyButton = this.add.image(1350, 50, 'rangedTroopBuy').setInteractive();
        rangedBuyButton.on('pointerdown', () => {

            if (gameConfig.coins.player >= 25) {

                if (gameConfig.troopsInQueue.player < 5) {
                    gameConfig.coins.player -= 50;
                    gameConfig.troopsInQueue.player += 1;
                    this.time.addEvent(this.timedEventProgressBar);

                    const delay = gameConfig.troopsInQueue.player * 3000;

                    setTimeout(() => {
                        const troop = new PlayerTroopGameObject(this, 110, 320, 'rangedTroop', false);
                        troop.deathAnimation = false;
                        troop.attackDamage = 15;
                        this.unitTroopGroup.add(troop);
                        gameConfig.troopsInQueue.player -= 1;
                        this.progressFill.width = 0;
                    }, delay);
                }
            }
        }, this);

        const tankBuyButton = this.add.image(1400, 50, 'tankTroopBuy').setInteractive();
        tankBuyButton.on('pointerdown', () => {

            if (gameConfig.coins.player >= 25) {

                if (gameConfig.troopsInQueue.player < 5) {
                    gameConfig.coins.player -= 100;
                    gameConfig.troopsInQueue.player += 1;
                    this.time.addEvent(this.timedEventProgressBar);

                    const delay = gameConfig.troopsInQueue.player * 3000;

                    setTimeout(() => {
                        const troop = new PlayerTroopGameObject(this, 110, 320, 'tankTroop', false);
                        troop.deathAnimation = false;
                        troop.attackDamage = 30;
                        this.unitTroopGroup.add(troop);
                        gameConfig.troopsInQueue.player -= 1;
                        this.progressFill.width = 0;
                    }, delay);
                }
            }
        }, this);

        const enemyMeleeBuyButton = this.add.image(1450, 50, 'meleeTroopBuy').setInteractive();
        enemyMeleeBuyButton.on('pointerdown', () => {
            console.log(gameConfig.coins.enemy);

            if (gameConfig.coins.enemy >= 25) {
                console.log(gameConfig.troopsInQueue.enemy);

                if (gameConfig.troopsInQueue.enemy < 5) {
                    gameConfig.coins.enemy -= 25;
                    gameConfig.troopsInQueue.enemy += 1;

                    const delay = gameConfig.troopsInQueue.enemy * 3000;

                    setTimeout(() => {
                        const troop = new PlayerTroopGameObject(this, 1390, 320, 'meleeTroop', true);

                        troop.deathAnimation = false;
                        troop.attackDamage = 20;
                        this.unitTroopGroup.add(troop);
                        gameConfig.troopsInQueue.enemy -= 1;
                    }, delay);
                }
            }
        }, this);

        for (let i = 0; i < 5; i++) {
            additive += 20;
            let r = this.add.rectangle(additive, 50, 15, 15, 0xc4c4c4);
            rectangles.push(r);
        }

        this.progress = this.add.rectangle(200, 50, 200, 12, 0xc4c4c4);
        this.progressFill = this.add.rectangle(200, 50, 200, 11, 0xF70000);

        this.progressFill.width = 0.1;

        this.progress.isFilled = false;
        this.progress.setStrokeStyle(1, 0x000000);

        this.returnKey = this.input.keyboard.addKey(Phaser.Input.Keyboard.KeyCodes.ENTER);

        this.returnKey.on("down", event => { // als enter word ingedrukt
            let name = this.nameInput.getChildByName("name");
            if (name.value !== "") {
                this.spelling.alpha = 0;
                this.message.setText(sanitize(name.value));
                var similarity = stringSimilarity.compareTwoStrings(randomPair.translation, name.value.toLowerCase());
                if (similarity > 0.98) {
                    gameConfig.coins.player += 25;
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
        this.troops.forEach(troop => {
            if (troop.health >= 0) {
                troop.update();
            }
        });

        this.Enemytroops.forEach(troop => {
            if (troop.health >= 0) {
                troop.update();
            }
        });

        this.money.setText(gameConfig.coins.player);

        for (let i = 0; i < rectangles.length; i++) {
            rectangles[i].setStrokeStyle(1, 0x000000);
            if (gameConfig.troopsInQueue.player >= (i + 1)) {
                rectangles[i].isFilled = true;
            } else {
                rectangles[i].isFilled = false;
            }
        }

        const progress = this.timedEvent.getProgress();
        const progressBar = this.timedEventProgressBar.getProgress();

        if (progressBar >= 0.01 && this.progressFill.width >= 0 && this.progressFill.width < 200 && progressBar < 1) {
            const decreaseStep = () => {
                if (this.progressFill.width <= 200) {
                    this.progressFill.width += 0.04;
                    setTimeout(decreaseStep, 100);
                }
            };
            decreaseStep();
        }

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
