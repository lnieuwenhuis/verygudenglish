<!DOCTYPE html>
<html>
<head>
{{--    <meta charset="utf-8">--}}
{{--    <meta name="viewport" content="width=device-width, initial-scale=1">--}}
{{--    <meta name="csrf-token" content="{{ csrf_token() }}">--}}
{{--    @vite('resources/css/app.css')--}}


{{--    <title>{{ config('app.name', 'Laravel') }}</title>--}}

{{--    <!-- Fonts -->--}}
{{--    <link rel="preconnect" href="https://fonts.bunny.net">--}}
{{--    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />--}}

{{--    <!-- Scripts -->--}}
{{--    @vite(['resources/css/app.css', 'resources/js/app.js'])--}}
    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <script src="https://cdn.jsdelivr.net/npm/phaser@3.60.0/dist/phaser-arcade-physics.min.js"></script>
</head>
<body  class="bg-blue-900">

<script>
    let exploding = false
    let maxMeteorsToShow = 1
    let idx = 0
    let meteoor
   // let meteoor = physics.add.sprite(x, 1, 'meteoor');

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
            this.add.image(750, 370, 'sky');
            this.nameInput = this.add.dom(755, 428).createFromCache("htmlForm")
            this.maxMeteorsToShow = 1
            this.idx = 0
            this.exploding = false
            // const particles = this.add.particles(0, 0, 'green', {
            //     speed: 500,
            //     scale: { start: 0.4, end: 5 },
            //     blendMode: 'ADD'
            // });
            //
            // animatie aanmaken
            this.anims.create({
                key: 'explode',
                frames: this.anims.generateFrameNumbers('meteoor', { frames: [ 0, 1, 2, 3 , 4, 5 ,6 ] }),
                frameRate: 10,
                repeat: 0,
            });





        }

        update () {
            //Meteoor opniew inspawnen als hij kapot is
            if(this.idx < this.maxMeteorsToShow) {
                console.log('hoi')
                // for( this.idx = 0; this.idx < maxMeteorsToShow; this.idx++) {
                     const x = Phaser.Math.Between(1500, config.width - 1500);
                    this.meteoor = this.physics.add.sprite(x, 1, 'meteoor');
                    this.meteoor.setScale(7);
                    this.meteoor.setSize(50, 40, true);


                    // particles.startFollow(logo);
                    //meteoor.setVelocity(100, 200);
                    //meteoor.setBounce(1,1);
                    this.meteoor.setCollideWorldBounds(true);
                    this.idx++;
                // }
            }
                if(this.exploding == false){
                    if (this.meteoor.y >= 650){

                        this.exploding = true
                        this.meteoor.play('explode');
                        this.meteoor.on(Phaser.Animations.Events.ANIMATION_COMPLETE, function () {
                            this.meteoor.destroy();
                            this.idx--
                            this.exploding = false
                        }, this);

                    }
                }


        }
    }

    const config = {
        type: Phaser.AUTO,
        width: 1500,
        height: 800,
        scene: Example,
        physics: {
            default: 'arcade',
            arcade: {
                gravity: { y: 25 }
            }
        }
    };

    const game = new Phaser.Game(config);
</script>

</body>
</html>
