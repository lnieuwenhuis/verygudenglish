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

    class BuildingGameObject extends Phaser.Physics.Arcade.Sprite {
        constructor(scene, x, y, troopType, group) {
            super(scene, x, y, troopType, group);
            this.health = 1000;
            this.isEnemy = group;
            this.buildings = this.scene.BuildingGroup;
            this.troops = this.scene.BuildingGroup;

            this.setScale(0.4);

            if (this.isEnemy) {
                this.flipX = true;
                this.buildingHealthText = this.scene.add.text(1360, 350, "", {
                    color: "#ff0000",
                    fontSize: '30px',
                    fontStyle: "bold",
                }).setOrigin(0.5, 7);
            } else {
                this.health += 100
                this.buildingHealthText = this.scene.add.text(140, 350, "", {
                    color: "#ff0000",
                    fontSize: '30px',
                    fontStyle: "bold",
                }).setOrigin(0.5, 7);
            }

            scene.physics.add.existing(this);

            scene.physics.world.enable(this);

            this.setCollideWorldBounds(true);

            scene.add.existing(this);

            this.isCollidingUnit = false;

            // this.setupColliders();
        }

        update() {
            this.setVelocity(0);

            if (this.isDead()) {
                this.handleDeadBuilding(this);
            }

            this.buildingHealthText.setText(this.health);
        }

        handleDeadBuilding(build) {
            if (build.isEnemy) {
                build.destroy();
                gameConfig.win.player = true;
            } else {
                build.destroy();
                gameConfig.win.enemy = true;
            }
        }

        isDead() {
            return this.health <= 0;
        }
    }

    class PlayerTroopGameObject extends Phaser.Physics.Arcade.Sprite {
        constructor(scene, x, y, troopType, group) {
            super(scene, x, y, troopType, group);
            this.isEnemy = group;

            this.movementSpeed = 0;
            this.units = this.scene.unitTroopGroup;
            this.buildings = this.scene.BuildingGroup;

            if (!this.isEnemy) {
                this.movementSpeed = 40;
                this.health += 10
            } else {
                this.movementSpeed = -40;
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
            this.once('animationcomplete', () => {
                this.playerNewAnimation = true;
            });

            if (this.attacking && this.troopType === "meleeTroop") {
                this.setScale(0.45);
            } else {
                if (this.troopType === "meleeTroop") {
                    this.setScale(0.35);
                }
            }

            if (!this.isDead() && !this.isCollidingUnit) {
                if (this.troopType === "meleeTroop") {
                    this.setScale(0.35);
                }
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
                if (this.playerNewAnimation) {
                    this.playerNewAnimation = false;
                    this.play(this.troopType + 'AttackAnimation');
                }
            }
        }

        setupColliders() {
            this.overlap = this.scene.physics.add.overlap(this.units,this.units,this.handleUnitCollision, null, this)
            this.overlapBuilding = this.scene.physics.add.overlap(this.units,this.buildings,this.handleUnitCollision, null, this)
        }

        handleUnitCollision(me, other) {
            if (!me.isDead() && !me.isCollidingUnit) {
                me.setPushable(false);
                me.setVelocityX(0);

                if ((me.isEnemy && other.isEnemy) || ((!me.isEnemy  && !other.isEnemy))) {
                    me.attacking = false;
                    me.isCollidingUnit = false;
                    me.playerNewAnimation = true;
                } else {
                    me.isCollidingUnit = true;
                    me.attacking = true;
                    me.playerNewAnimation = true;
                    if (!other.isDead()) {
                        me.once('animationcomplete', () => {
                            other.health -= getRandomInt(me.attackDamage - 10, me.attackDamage);
                            me.playerNewAnimation = true;
                            me.isCollidingUnit = false;
                            me.attacking = false;
                        });
                    }
                }
                me.play(me.troopType + 'IdleAnimation');
            }
        }

        handleDeadTroop(player) {
            if (!player.deathAnimation) {
                player.setVelocityX(0);
                player.attacking = false;
                player.deathAnimation = true;
                player.play(player.deathAnimationKey);
                if (player.isEnemy) {
                    gameConfig.alive.enemy -= 1
                } else {
                    gameConfig.coins.enemy += 40;
                }
                player.once('animationcomplete', () => {
                    setTimeout(() => {
                        player.destroy();
                        this.units.getChildren().forEach(child => {
                            child.isCollidingUnit = false;
                            child.newAnimation = true;
                        })
                    }, 2000);
                });
            }
        }

        isDead() {
            return this.health <= 0;
        }
    }

    const phaserConfig = {
        type: Phaser.AUTO,
        parent: "game",
        width: 1510,
        height: 455,
        backgroundColor: '#774F35',
        antialias: true,
        key: "scene",
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
            aiStructure: 1250,
        },
        troopDamage: {
            meleeTroop: 50,
            rangedTroop: 25,
            tankTroop: 100,
        },
        troopRange: {
            meleeTroop: 20,
            rangedTroop: 40,
            tankTroop: 50,
        },
        troopSpeed: {
            meleeTroop: 2,
            rangedTroop: 2,
            tankTroop: 1,
        },
        queueTime: {
            meleeTroop: 2,
            rangedTroop: 2,
            tankTroop: 3,
        },
        spawnCost: {
            meleeTroop: 25,
            tankTroop: 100,
        },
        coins: {
            player: 175,
            enemy: 200,
        },
        troopsInQueue: {
            player: 0,
            enemy: 0,
        },
        alive: {
            enemy: 0,
        },
        win: {
            player: false,
            enemy: false,
        }
    };

    const game = new Phaser.Game(phaserConfig);
    let rectangles = [];
    let progressBar = [];
    let additive = 300
    let isSpawningUnit = false;

    function preloadScene() { // images & html laden
        this.load.html("htmlForm", "../storage/html/ageofwords/form.html");
        this.load.image('background', '../storage/images/ageofwords/shapes/background/background3.png');
        this.load.image('cave', '../storage/images/ageofwords/shapes/building/cave.png');
        this.load.image('coins', '../storage/images/ageofwords/shapes/money/coins.png');
        this.load.image('meleeTroopBuy', '../storage/images/ageofwords/buttons/meleeTroop.png');
        this.load.image('rangedTroopBuy', '../storage/images/ageofwords/buttons/rangedTroop.png');
        this.load.image('tankTroopBuy', '../storage/images/ageofwords/buttons/tankTroop.png');
        this.load.spritesheet('meleeTroop', '../storage/images/ageofwords/sprites/troops/meleeTroop.png', { frameWidth: 137, frameHeight: 180, endFrame: 43 });
        this.load.spritesheet('meleeTroopIdle', '../storage/images/ageofwords/sprites/troops/idle/meleeTroop.png', { frameWidth: 97, frameHeight: 174, endFrame: 50 });
        this.load.spritesheet('meleeTroopDeath', '../storage/images/ageofwords/sprites/troops/death/meleeDeath.png', { frameWidth: 225, frameHeight: 180, endFrame: 24 });
        this.load.spritesheet('meleeTroopAttack', '../storage/images/ageofwords/sprites/troops/attack/meleeTroop.png', { frameWidth: 170, frameHeight: 175, endFrame: 40 });
        this.load.spritesheet('tankTroop', '../storage/images/ageofwords/sprites/troops/tankTroop.png', { frameWidth: 180, frameHeight: 133, endFrame: 40 });
        this.load.spritesheet('tankTroopIdle', '../storage/images/ageofwords/sprites/troops/idle/tankTroop.png', { frameWidth: 178, frameHeight: 131, endFrame: 48 });
        this.load.spritesheet('tankTroopDeath', '../storage/images/ageofwords/sprites/troops/death/tankDeath.png', { frameWidth: 280, frameHeight: 148, endFrame: 50 });
        this.load.spritesheet('tankTroopAttack', '../storage/images/ageofwords/sprites/troops/attack/tankAttack.png', { frameWidth: 218, frameHeight: 134, endFrame: 45 });
    }

    function createScene() {
        this.add.image(750, 150, 'background');
        this.nameInput = this.add.dom(755, 428).createFromCache("htmlForm");
        this.physics.world.setBounds(32, 115, 1500, 240);

        const troopConfigurations = [
            {key: 'meleeTroop', frameRate: 43, frameNumbers: {start: 0, end: 42, first: 0}, repeat: -1},
            {key: 'meleeTroopIdle', frameRate: 43, frameNumbers: {start: 0, end: 50, first: 0}, repeat: 0},
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

        this.unitTroopGroup = this.physics.add.group({
            defaultKey: 'unitTroop',
            maxSize: -1,
            runChildUpdate: true,
            collideWorldBounds: true
        });

        this.BuildingGroup = this.physics.add.group({
            defaultKey: 'buildingGroup',
            maxSize: -1,
            runChildUpdate: true,
            collideWorldBounds: true
        });

        this.troops = [];
        this.buildings = [];

        const playerBuilding = new BuildingGameObject(this, 50, 270, 'cave', false);

        this.BuildingGroup.add(playerBuilding);

        const enemyBuilding = new BuildingGameObject(this, 1380, 270, 'cave', true);

        this.BuildingGroup.add(enemyBuilding);

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
            if (gameConfig.coins.player >= 25) {
                if (gameConfig.troopsInQueue.player < 5) {
                    gameConfig.coins.player -= 25;
                    gameConfig.troopsInQueue.player += 1;

                    const delay = gameConfig.troopsInQueue.player * 3000;

                    setTimeout(() => {
                        const troop = new PlayerTroopGameObject(this, 200, 320, 'meleeTroop', false);
                        troop.deathAnimation = false;
                        troop.attackDamage = 15;
                        troop.health = 100;
                        this.unitTroopGroup.add(troop);
                        gameConfig.troopsInQueue.player -= 1;
                    }, delay);
                }
            }
        }, this);

        const tankBuyButton = this.add.image(1350, 50, 'tankTroopBuy').setInteractive();
        tankBuyButton.on('pointerdown', () => {
            if (gameConfig.coins.player >= 100) {

                if (gameConfig.troopsInQueue.player < 5) {
                    gameConfig.coins.player -= 100;
                    gameConfig.troopsInQueue.player += 1;

                    const delay = gameConfig.troopsInQueue.player * 3000;

                    setTimeout(() => {
                        const troop = new PlayerTroopGameObject(this, 200, 320, 'tankTroop', false);
                        troop.deathAnimation = false;
                        troop.attackDamage = 70;
                        troop.health = 300;
                        this.unitTroopGroup.add(troop);
                        gameConfig.troopsInQueue.player -= 1;
                    }, delay);
                }
            }
        }, this);

        // const enemyMeleeBuyButton = this.add.image(1450, 50, 'meleeTroopBuy').setInteractive();
        // enemyMeleeBuyButton.on('pointerdown', () => {
        //     if (gameConfig.coins.enemy >= 25) {
        //
        //         if (gameConfig.troopsInQueue.enemy < 5) {
        //             gameConfig.coins.enemy -= 25;
        //             gameConfig.troopsInQueue.enemy += 1;
        //
        //             const delay = gameConfig.troopsInQueue.enemy * 3000;
        //
        //             setTimeout(() => {
        //                 const troop = new PlayerTroopGameObject(this, 1300, 320, 'meleeTroop', true);
        //
        //                 troop.deathAnimation = false;
        //                 troop.attackDamage = 20;
        //                 troop.health = 100;
        //                 this.unitTroopGroup.add(troop);
        //                 gameConfig.troopsInQueue.enemy -= 1;
        //             }, delay);
        //         }
        //     }
        // }, this);

        for (let i = 0; i < 5; i++) {
            additive += 20;
            let r = this.add.rectangle(additive, 50, 15, 15, 0xc4c4c4);
            rectangles.push(r);
        }

        let r = this.add.rectangle(200, 50, 200, 12, 0xc4c4c4);
        r.isFilled = false;
        r.setStrokeStyle(1, 0x000000);


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

        if (gameConfig.win.player) {
            game.destroy(true);
            const newDiv = document.createElement("div");

            // and give it some content
            const newContent = document.createTextNode("Je hebt gewonnen");

            // add the text node to the newly created div
            newDiv.appendChild(newContent);

            // add the newly created element and its content into the DOM
            const currentDiv = document.getElementById("div1");
            document.body.insertBefore(newDiv, currentDiv);
        } else if (gameConfig.win.enemy) {
            game.destroy(true);
            const newDiv = document.createElement("div");

            // and give it some content
            const newContent = document.createTextNode("Je hebt verloren");

            // add the text node to the newly created div
            newDiv.appendChild(newContent);

            // add the newly created element and its content into the DOM
            const currentDiv = document.getElementById("div1");
            document.body.insertBefore(newDiv, currentDiv);
        }

        if (gameConfig.alive.enemy <= 5) {
            if (gameConfig.coins.enemy >= 100) {
                if (gameConfig.troopsInQueue.enemy < 5) {
                    gameConfig.coins.enemy -= 100;
                    gameConfig.alive.enemy += 1;
                    gameConfig.troopsInQueue.enemy += 1;

                    const delay = gameConfig.troopsInQueue.enemy * 3000;

                    setTimeout(() => {
                        const troop = new PlayerTroopGameObject(this, 1390, 320, 'tankTroop', true);

                        troop.deathAnimation = false;
                        troop.attackDamage = 70;
                        troop.health = 100;
                        troop.isEnemy = true;
                        this.unitTroopGroup.add(troop);
                        gameConfig.troopsInQueue.enemy -= 1;
                    }, delay);
                }
            } else {
                if (gameConfig.coins.enemy >= 25) {
                    if (gameConfig.troopsInQueue.enemy < 5) {
                        gameConfig.coins.enemy -= 25;
                        gameConfig.alive.enemy += 1;
                        gameConfig.troopsInQueue.enemy += 1;

                        const delay = gameConfig.troopsInQueue.enemy * 3000;

                        setTimeout(() => {
                            const troop = new PlayerTroopGameObject(this, 1390, 320, 'meleeTroop', true);

                            troop.deathAnimation = false;
                            troop.attackDamage = 20;
                            troop.health = 100;
                            troop.isEnemy = true;
                            this.unitTroopGroup.add(troop);
                            gameConfig.troopsInQueue.enemy -= 1;
                        }, delay);
                    }
                }
            }
        }

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

        // if (progressBar >= 0.01 && this.progressFill.width >= 0 && this.progressFill.width < 200) {
        //     const decreaseStep = () => {
        //         if (this.progressFill.width <= 200) {
        //             this.progressFill.width += 0.04;
        //             setTimeout(decreaseStep, 100);
        //         }
        //     };
        //     decreaseStep();
        // }

        for (let i = 0; i < gameConfig.troopsInQueue.player; i++) {
            let progress = this.add.rectangle(100, 50, 0, 11, 0xF70000);
            if (gameConfig.troopsInQueue.player >= (i + 1)) {
                const decreaseStep = () => {
                    if (gameConfig.troopsInQueue.player >= 1) {
                        if (progress.width <= 194) {
                            progress.width += 10;
                        }
                    } else {
                        progress.width = 0;
                    }
                    setTimeout(decreaseStep, 150);
                };

                decreaseStep();
            }
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
