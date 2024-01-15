<!DOCTYPE html>
<html>
<head>
    <script src="https://cdn.jsdelivr.net/npm/phaser@3.60.0/dist/phaser-arcade-physics.min.js"></script>
</head>
<body>

<script>
    let exploding = false
    let maxMeteorsToShow = 1
    class Example extends Phaser.Scene
    {
        preload ()
        {

            this.load.image('sky', 'storage/images/meteoor/background.png');
            // this.load.image('meteoor', 'storage/images/meteoor/meteoor.png');
            this.load.spritesheet('meteoor', 'storage/images/meteoor/meteoor.png', { frameWidth: 75, frameHeight: 76 });
            this.load.image('green', 'assets/particles/green.png');
        }

        create ()
        {
            this.add.image(750, 280, 'sky');

            // const particles = this.add.particles(0, 0, 'green', {
            //     speed: 500,
            //     scale: { start: 0.4, end: 5 },
            //     blendMode: 'ADD'
            // });
            //
            this.anims.create({
                key: 'explode',
                frames: this.anims.generateFrameNumbers('meteoor', { frames: [ 0, 1, 2, 3 , 4, 5 ,6 ] }),
                frameRate: 10,
                repeat: 0,
            });

            for(let idx = 0; idx < maxMeteorsToShow; idx++) {
                const x = Phaser.Math.Between(1500, config.width - 1500);
                this.meteoor = this.physics.add.sprite(x, 1, 'meteoor');
                this.meteoor.setScale(7);
                this.meteoor.setSize(50, 40, true);


                // particles.startFollow(logo);
                //meteoor.setVelocity(100, 200);
                //meteoor.setBounce(1,1);
                this.meteoor.setCollideWorldBounds(true);
            }



        }

        update () {

                if(exploding == false){
                    if (this.meteoor.y >= 500){

                        exploding = true
                        this.meteoor.play('explode');
                        this.meteoor.on(Phaser.Animations.Events.ANIMATION_COMPLETE, function () {
                            this.meteoor.destroy();
                        }, this);

                    }
                }


        }
    }

    const config = {
        type: Phaser.AUTO,
        width: 1500,
        height: 700,
        scene: Example,
        physics: {
            default: 'arcade',
            arcade: {
                gravity: { y: 200 }
            }
        }
    };

    const game = new Phaser.Game(config);
</script>

</body>
</html>
