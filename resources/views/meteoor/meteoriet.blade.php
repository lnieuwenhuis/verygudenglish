<!DOCTYPE html>
<html>
<head>
    <script src="https://cdn.jsdelivr.net/npm/phaser@3.60.0/dist/phaser-arcade-physics.min.js"></script>
</head>
<body>

<script>
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
                frameRate: 5,
                repeat: 0,
                hideOnComplete: true,
            });
            const meteoor = this.physics.add.sprite(75, 76, 'meteoor');
            meteoor.setScale(7);
            meteoor.play('explode');

            meteoor.setVelocity(100, 200);
            meteoor.setBounce(1,1);
            meteoor.setCollideWorldBounds(true);

            // particles.startFollow(logo);
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
