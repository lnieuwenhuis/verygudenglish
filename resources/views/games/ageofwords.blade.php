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

        function isObjEmpty(obj) { // check of object leeg is
            return Object.keys(obj).length === 0;
        }

        let randomPair = getRandomKeyValuePair(); // random key & value pakken

        class PlayerTroopGameObject extends Phaser.Physics.Arcade.Sprite {
            constructor(scene, x, y, troopType, group) {
                super(scene, x, y, troopType, group);

                this.name = Math.random(0,999999999)
                console.log("name")
                console.log(this.name)
                this.isPlayer = false;

                this.movementSpeed = 0
                this.friendly = this.scene.troopGroup
                this.enemy = this.scene.EnemytroopGroup
                this.units = this.scene.unitTroopGroup
                if (!group) {
                    this.movementSpeed = 40
                    this.friendly = this.scene.troopGroup
                    this.enemy = this.scene.EnemytroopGroup
                } else {
                    this.movementSpeed = -500
                    this.friendly = this.scene.EnemytroopGroup
                    this.enemy = this.scene.troopGroup
                    this.flipX = true;
                }
                this.playerNewAnimation = true;
                this.attacking = false;
                this.isColliding = false;

                this.setScale(0.45);
                this.troopType = troopType;
                this.deathAnimationKey = troopType + 'DeathAnimation';
                if (this.deathAnimationKey === 'tankTroopDeathAnimation') {
                    this.setScale(0.6);
                }

                this.inZone = false;

                scene.physics.add.existing(this);

                scene.physics.world.enable(this);

                this.setCollideWorldBounds(true);

                scene.add.existing(this);

                this.isCollidingTroop = false;
                this.isCollidingEnemy = false;
                this.isCollidingUnit = false;

                this.setupColliders();
            }

            setupColliders() {
                // this.collider = this.scene.physics.add.collider(this.enemy,this.friendly,this.handleUnitCollision, null, this)
                // this.collider = this.scene.physics.add.collider(this.friendly,this.enemy,this.handleUnitCollision, null, this)
                // this.collider = this.scene.physics.add.collider(this.enemy,this.enemy,this.handleUnitCollision, null, this)
                // this.collider = this.scene.physics.add.collider(this.friendly,this.friendly,this.handleUnitCollision, null, this)

                this.collider = this.scene.physics.add.collider(this.units,this.units,this.handleUnitCollision, null, this)

                // this.colliderFriendly = this.scene.physics.add.collider(this.friendly, this.friendly, this.handleTroopCollision, null, this);
                // this.collider = this.scene.physics.add.collider(this.enemy, this.enemy, this.handleTroopCollision, null, this);
                // this.colliderEnemy = this.scene.physics.add.collider(this.friendly, this.enemy, this.handleEnemyCollision, null, this);
                // this.colliderFriendly = this.scene.physics.add.collider(this, this.friendly, this.handleTroopCollision, null, this);
                // this.colliderEnemy = this.scene.physics.add.collider(this, this.enemy, this.handleEnemyCollision, null, this);
            }

            handleTroopCollision(player, troop) {
                if (!troop.isDead() && !player.isCollidingTroop) {
                    this.handleFriendlyInteraction(player,troop);
                }

                if (player.isDead()) {
                    this.handleDeadTroop(player);
                }
                if (troop.isDead()) {
                    this.handleDeadTroop(troop);
                }
            }


            handleUnitCollision(me, other) {
                if (!me.isDead() && !me.isCollidingUnit && !other.isDead()) {

                    console.log("collision")
                    me.play(other.troopType + 'IdleAnimation');
                    me.setPushable(false);
                    me.setVelocityX(0);
                    me.isCollidingEnemy = true;
                    me.attacking = true;
                    other.play(other.troopType + 'IdleAnimation');
                    other.setPushable(false);
                    other.setVelocityX(0);
                    other.isCollidingEnemy = true;
                    other.attacking = true;
                }

                // if (player.isDead()) {
                //     this.handleDeadTroop(player);
                // }
                // if (troop.isDead()) {
                //     this.handleDeadTroop(troop);
                // }
            }
            handleEnemyCollision(player, troop) {
                console.log("player: " + player.name)
                console.log("ene: " + troop.name)
                if (!troop.isDead() && !player.isCollidingEnemy) {
                    this.handleEnemyInteraction(player, troop);
                }

                if (player.isDead()) {
                    this.handleDeadTroop(player);
                }
                if (troop.isDead()) {
                    this.handleDeadTroop(troop);
                }
            }

            handleFriendlyInteraction(player,troop) {
                console.log("friendly collision")
                console.log(troop.name)
                troop.play(troop.troopType + 'IdleAnimation');
                troop.setPushable(false);
                troop.setVelocityX(0);
                troop.isCollidingTroop = true;
                troop.attacking = false;
                console.log(troop.isCollidingTroop)
                console.log(troop.isCollidingEnemy)
            }

            handleEnemyInteraction(player, troop) {
                console.log("enemy collision")
                player.play(troop.troopType + 'IdleAnimation');
                player.setPushable(false);
                player.setVelocityX(0);
                player.isCollidingEnemy = true;
                player.attacking = true;
                troop.play(troop.troopType + 'IdleAnimation');
                troop.setPushable(false);
                troop.setVelocityX(0);
                troop.isCollidingEnemy = true;
                troop.attacking = true;
            }


            handleDeadTroop(player) {
                console.log("dead")
                player.setVelocityX(0);
                if (player.isDead() && !player.deathAnimation) {
                    player.deathAnimation = true;
                    player.play(player.deathAnimationKey);
                    player.once('animationcomplete', () => {
                        setTimeout(() => {
                            player.destroy();
                        }, 2000);
                    });
                }
            }

            update() {
                if (!this.isDead() && !this.isCollidingEnemy && !this.isCollidingTroop) {
                    this.setVelocityX(this.movementSpeed);
                    if (this.playerNewAnimation) {
                        this.playerNewAnimation = false;
                        this.play(this.troopType + 'Animation');
                    }
                }
            }

            isDead() {
                return this.health <= 0;
            }
        }
        //
        // class EnemyTroopGameObject extends Phaser.Physics.Arcade.Sprite {
        //     constructor(scene, x, y, troopType) {
        //         super(scene, x, y, troopType);
        //
        //         this.newAnimation = true;
        //         this.flipX = true;
        //
        //         this.setScale(0.45);
        //         this.troopType = troopType;
        //         this.deathAnimationKey = troopType + 'DeathAnimation';
        //         if (this.deathAnimationKey === 'tankTroopDeathAnimation') {
        //             this.setScale(0.6);
        //         }
        //
        //         this.inZone = false;
        //
        //         scene.physics.add.existing(this);
        //
        //         scene.physics.world.enable(this);
        //
        //         this.attacking = false;
        //
        //         this.setCollideWorldBounds(true);
        //
        //         scene.add.existing(this);
        //
        //         this.isCollidingTroop = false;
        //         this.isCollidingEnemy = false;
        //
        //         this.setupColliders();
        //     }
        //
        //     setupColliders() {
        //         this.collider = this.scene.physics.add.collider(this, this.scene.EnemytroopGroup, this.handleTroopCollision, null, this);
        //         this.colliderEnemy = this.scene.physics.add.collider(this, this.scene.troopGroup, this.handleEnemyCollision, null, this);
        //     }
        //
        //     handleTroopCollision(player, troop) {
        //         if (!troop.isDead() && !player.isCollidingTroop) {
        //             this.handleFriendlyInteraction(player, troop);
        //         }
        //
        //         if (troop.isDead()) {
        //             this.handleDeadTroop(player);
        //         }
        //     }
        //
        //     handleEnemyCollision(player, troop) {
        //         if (!troop.isDead() && !player.isCollidingEnemy) {
        //             this.handleEnemyInteraction(player, troop);
        //         }
        //
        //         if (troop.isDead()) {
        //             this.handleDeadTroop(troop);
        //         }
        //     }
        //
        //     handleFriendlyInteraction(player, troop) {
        //         player.play(player.troopType + 'IdleAnimation');
        //         player.setVelocityX(0);
        //         player.setPushable(false);
        //         player.isCollidingTroop = true;
        //         player.attacking = false;
        //     }
        //
        //     handleEnemyInteraction(player, troop) {
        //         console.log("test");
        //         player.play(troop.troopType + 'IdleAnimation');
        //         player.setPushable(false);
        //         player.setVelocityX(0);
        //         player.isCollidingEnemy = true;
        //         player.attacking = true;
        //         troop.health = 0;
        //     }
        //
        //     handleDeadTroop(player) {
        //         console.log("karel")
        //         player.setVelocityX(0);
        //         if (player.isDead() && !player.deathAnimation) {
        //             player.deathAnimation = true;
        //             player.play(player.deathAnimationKey);
        //             player.once('animationcomplete', () => {
        //                 setTimeout(() => {
        //                     player.destroy();
        //                 }, 2000);
        //             });
        //         }
        //     }
        //
        //     update() {
        //         if (!this.isDead() && !this.isCollidingEnemy && !this.isCollidingTroop) {
        //             this.setVelocityX(-40);
        //             if (this.newAnimation) {
        //                 this.newAnimation = false;
        //                 this.play(this.troopType + 'Animation');
        //             }
        //         }
        //
        //     }
        //
        //     isDead() {
        //         return this.health <= 0;
        //     }
        // }

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
            this.load.image('building', 'storage/images/ageofwords/shapes/building/castle.png');
            this.load.image('meleeTroopBuy', 'storage/images/ageofwords/buttons/meleeTroop.png');
            this.load.image('rangedTroopBuy', 'storage/images/ageofwords/buttons/rangedTroop.png');
            this.load.image('tankTroopBuy', 'storage/images/ageofwords/buttons/tankTroop.png');
            this.load.spritesheet('meleeTroop', 'storage/images/ageofwords/sprites/troops/meleeTroop.png', { frameWidth: 103, frameHeight: 135, endFrame: 43 });
            this.load.spritesheet('meleeTroopIdle', 'storage/images/ageofwords/sprites/troops/idle/meleeTroop.png', { frameWidth: 73, frameHeight: 131, endFrame: 50 });
            this.load.spritesheet('meleeTroopDeath', 'storage/images/ageofwords/sprites/troops/death/meleeDeath.png', { frameWidth: 168, frameHeight: 162, endFrame: 24 });
            this.load.spritesheet('meleeTroopAttack', 'storage/images/ageofwords/sprites/troops/attack/meleeTroop.png', { frameWidth: 170, frameHeight: 175, endFrame: 40 });
            this.load.spritesheet('rangedTroop', 'storage/images/ageofwords/sprites/troops/rangedTroop.png', { frameWidth: 84, frameHeight: 135, endFrame: 43 });
            this.load.spritesheet('rangedTroopDeath', 'storage/images/ageofwords/sprites/troops/death/rangedDeath.png', { frameWidth: 163, frameHeight: 162, endFrame: 24 });
            this.load.spritesheet('tankTroop', 'storage/images/ageofwords/sprites/troops/tankTroop.png', { frameWidth: 180, frameHeight: 133, endFrame: 40 });
            this.load.spritesheet('tankTroopDeath', 'storage/images/ageofwords/sprites/troops/death/tankDeath.png', { frameWidth: 280, frameHeight: 148, endFrame: 50 });
        }

        function createScene() {
            this.add.image(750, 150, 'background');
            this.nameInput = this.add.dom(755, 428).createFromCache("htmlForm");
            console.log(this.nameInput)
            this.physics.world.setBounds(32, 115, 1500, 240);

            const troopConfigurations = [
                {key: 'meleeTroop', frameRate: 43, frameNumbers: {start: 0, end: 42, first: 0}, repeat: -1},
                {key: 'meleeTroopIdle', frameRate: 43, frameNumbers: {start: 0, end: 50, first: 0}, repeat: -1},
                {key: 'meleeTroopDeath', frameRate: 43, frameNumbers: {start: 0, end: 23, first: 0}, repeat: 0},
                {key: 'meleeTroopAttack', frameRate: 43, frameNumbers: {start: 0, end: 40, first: 0}, repeat: -1},

                {key: 'rangedTroop', frameRate: 43, frameNumbers: {start: 0, end: 43, first: 0}, repeat: -1},
                {key: 'rangedTroopDeath', frameRate: 43, frameNumbers: {start: 0, end: 23, first: 0}, repeat: 0},

                {key: 'tankTroop', frameRate: 43, frameNumbers: {start: 0, end: 40, first: 0}, repeat: -1},
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

            this.unitTroopGroup = this.physics.add.group({
                defaultKey: 'unitTroop',
                maxSize: -1,
                runChildUpdate: true,
                collideWorldBounds: true
            });

            this.troopGroup = this.physics.add.group({
                defaultKey: 'troop',
                maxSize: -1,
                runChildUpdate: true,
                collideWorldBounds: true
            });

            this.EnemytroopGroup = this.physics.add.group({
                defaultKey: 'Enemytroop',
                maxSize: -1,
                runChildUpdate: true,
                collideWorldBounds: true
            });

            this.troops = [];
            this.Enemytroops = [];

            this.spelling = this.add.text(670, 510, "Let op je spelling", {
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

                        const delay = gameConfig.troopsInQueue.player * 3000;

                        setTimeout(() => {
                            const troop = new PlayerTroopGameObject(this, 0, 300, 'meleeTroop', false);
                            troop.health = 100;
                            troop.deathAnimation = false;
                            this.troops.push(troop);
                            this.troopGroup.add(troop);
                            this.unitTroopGroup.add(troop);
                            gameConfig.troopsInQueue.player -= 1;
                        }, delay);
                    }
                }
            }, this);

            const rangedBuyButton = this.add.image(1350, 50, 'rangedTroopBuy').setInteractive();
            rangedBuyButton.on('pointerdown', () => {

                if (gameConfig.coins.player >= 25) {

                    if (gameConfig.troopsInQueue.player < 5) {
                        gameConfig.coins.player -= 25;
                        gameConfig.troopsInQueue.player += 1;

                        const delay = gameConfig.troopsInQueue.player * 3000;

                        setTimeout(() => {
                            const troop = new PlayerTroopGameObject(this, 0, 300, 'rangedTroop', false);
                            troop.health = 100;
                            troop.deathAnimation = false;
                            this.troops.push(troop);
                            this.troopGroup.add(troop);
                            this.unitTroopGroup.add(troop);
                            gameConfig.troopsInQueue.player -= 1;
                        }, delay);
                    }
                }
            }, this);

            const tankBuyButton = this.add.image(1400, 50, 'tankTroopBuy').setInteractive();
            tankBuyButton.on('pointerdown', () => {

                if (gameConfig.coins.player >= 25) {

                    if (gameConfig.troopsInQueue.player < 5) {
                        gameConfig.coins.player -= 25;
                        gameConfig.troopsInQueue.player += 1;

                        const delay = gameConfig.troopsInQueue.player * 3000;

                        setTimeout(() => {
                            const troop = new PlayerTroopGameObject(this, 0, 300, 'tankTroop', false);
                            troop.health = 100;
                            troop.deathAnimation = false;
                            this.troops.push(troop);
                            this.troopGroup.add(troop);
                            this.unitTroopGroup.add(troop);
                            gameConfig.troopsInQueue.player -= 1;
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
                            const troop = new PlayerTroopGameObject(this, 1500, 300, 'meleeTroop', true);
                            troop.health = 100;
                            troop.deathAnimation = false;
                            troop.isPlayer = true;
                            this.Enemytroops.push(troop);
                            this.EnemytroopGroup.add(troop);
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


            this.returnKey = this.input.keyboard.addKey(Phaser.Input.Keyboard.KeyCodes.ENTER);

            this.returnKey.on("down", event => { // als enter word ingedrukt
                let name = this.nameInput.getChildByName("name");
                if (name.value !== "") {
                    this.spelling.alpha = 0;
                    this.message.setText(sanitize(name.value));
                    var similarity = stringSimilarity.compareTwoStrings(randomPair.translation, name.value
                        .toLowerCase());
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

            for (let i = 0; i < rectangles.length; i++) {
                rectangles[i].setStrokeStyle(1, 0x000000);
                if (gameConfig.troopsInQueue.player >= (i + 1)) {
                    rectangles[i].isFilled = true;
                } else {
                    rectangles[i].isFilled = false;
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
    </script>

</body>

</html>
