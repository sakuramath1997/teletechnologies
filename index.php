<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <link rel="stylesheet" type="text/css" href="/assets/css/reset.css">
        <link rel="stylesheet" type="text/css" href="/assets/css/style.css">
        <title>teletechnologies</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
        <script src="/assets/js/cls/EventListener.js"></script>
        <script src="/assets/js/cls/ScrollManager.js"></script>
        <script src="/assets/js/cls/ClassToggler.js"></script>
    </head>
    <body>
        <header>
            <div class="wrapper">
                <div id="header-logo">
                    <a href="/">teletechnologies</a>
                </div>
                <div id="header-menu">
                    <div id="header-links" class="sm-invisible">
                        <div class="header-link"><a href="/">Home</a></div>
                        <div class="header-link"><a href="/#main-contact">Contact</a></div>
                    </div>
                    <div id="header-hamburger" class="open">
                        <span class="screen-reader-text">サイドバーとナビゲーションを切り替える</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </div>
                </div>
            </div>
        </header>
        <aside class="wrapper">
            <div id="hamburger">
                <div id="hamburger-back" class="invisible">
                    <div id="hamburger-front">
                        <div id="aside-hamburger-btn-holder">
                            <div id="aside-hamburger" class="closed">
                                <span class="screen-reader-text">ナビゲーション切り替え</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </div>
                        </div>
                        <div id="aside-info">
                            <div class="logo">
                                teletechnologies
                            </div>
                            <div>
                                Link
                                <p><a href="/">Home</a></p>
                                <p><a href="/#main-contact">Contact</a></p>
                            </div>
                            <div>
                                Address
                                <p>
                                    〒141-0033
                                </p>
                                <p>
                                    東京都品川区西品川1-1-1
                                </p>
                                <p>
                                    大崎ガーデンタワー９階
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </aside>
        <main class="wrapper">
            <div id="main-hero">
                <figure>
                    <img 
                        src="/assets/img/logo.png"
                        alt="ロゴ"
                    >
                </figure>
                <div>
                    <span>
                        COMING SOON
                    </span>
                </div>
                <div id="scroll-to-content" title="本文までスクロール">
                    <span class="screen-reader-text">本文までスクロール</span>
                </div>
            </div>
            <div id="main-contact">
                <section>
                    <h1>CONTACT</h1>
                    <p>お問い合わせはこちら</p>
                    <p>info[at]teletechnologies.tokyo</p>
                    <p>[at]は半角のアットマークに置き換えてください</p>
                </section>
            </div>
        </main>
        <footer>
            <div class="wrapper">
                <div id="footer-top">
                    <a href="/">teletechnologies</a>
                </div>
                <div id="footer-menu">
                    <div id="footer-links">
                        <div class="footer-link"><a>company</a></div>
                        <div class="footer-link"><a href="/#main-contact">contact</a></div>
                        <div class="footer-link"><a>public notice</a></div>
                    </div>
                </div>
                <div id="footer-copyright">
                    <span>COPYRIGHT © 2024 TELETECHNOLOGIES, INC. ALL RIGHTS RESERVED. </span>
                    <span>POWERED BY CREATEARK INC. </span>
                </div>
            </div>
        </footer>
    </body>
    
    <div id="script">
        <script>
            let cld_btn = document.getElementById('aside-hamburger');
            console.log(cld_btn);
            cld_btn.addEventListener('click', (e) => {
                console.log('clicked');
                let back = document.getElementById('hamburger-back');
                back.classList.remove('visible')
                back.classList.add('fading-out')
                setTimeout(() => {
                    console.log("Execution 0.5sec"); // Execution 0.5sec
                    back.classList.remove('fading-out')
                    back.classList.add('invisible')
                }, 500);
            })

            
            let open_btn = document.getElementById('header-hamburger');
            console.log(open_btn);
            open_btn.addEventListener('click', (e) => {
                console.log('clicked');
                let back = document.getElementById('hamburger-back');
                back.classList.remove('invisible')
                back.classList.add('fading-in')
                setTimeout(() => {
                    console.log("Execution 0.5sec"); // Execution 0.5sec
                    back.classList.remove('fading-in');
                    back.classList.add('visible');
                }, 1000);
            })
        </script>
        <script>
            const scrollManager = new ScrollManager();
            const classToggler = new ClassToggler();
            const scrollDirectionChangedEventListener = new EventListner('scrollDirectionChanged', [
                (e) => {
                    console.log('スクロール方向が変更されました:', e.detail.direction);
                },
                (e) => {
                    if(e.detail.direction === 'up' ){
                        console.log('up');
                    } else if(e.detail.direction === 'down') {
                        console.log('down');
                    } else {
                        console.log('oh');
                    }
                }
            ])
            const scrollUpStartedEventListener = new EventListner('scrollUpStarted', [
                (e) => {
                    console.log('上方向のスクロールが開始されました');
                },
                (e) => {
                    const headerElement = document.body.getElementsByTagName('header')[0];
                    headerElement.classList.remove('down');
                    headerElement.classList.add('up');
                }
            ]);
            const scrollDownStartedEventListener = new EventListner('scrollDownStarted', [
                (e) => {
                    console.log('下方向のスクロールが開始されました');
                },
                (e) => {
                    const headerElement = document.body.getElementsByTagName('header')[0];
                    headerElement.classList.remove('up');
                    headerElement.classList.add('down');
                }
            ]);

            
            window.addEventListener('scroll', (e)=>{
                const headerElement = document.body.getElementsByTagName('header')[0];
                if( window.scrollY > 100 ) {
                    headerElement.classList.add('unlock');
                } else {
                    headerElement.classList.remove('unlock');
                }
            });

            
            // イベント発火でIDにクラスを追加
            classToggler.addClassById('header-logo', 'click', 'hohoho');
            //

            classToggler.addClassById('header-logo', 'scrollUpStarted', 'up');
            classToggler.addClassById('header-logo', 'scrollDownStarted', 'down');
            // イベント発火でIDからクラスを削除
            classToggler.removeClassById('header-logo', 'scrollUpStarted', 'down');
            classToggler.removeClassById('header-logo', 'scrollDownStarted', 'up');
            // クラス名を持つ要素にクラスを追加
            classToggler.addClassByClassName('wrapper', 'scrollUpStarted', 'up');
            classToggler.addClassByClassName('wrapper', 'scrollDownStarted', 'down');
            // クラス名を持つ要素からクラスを削除
            classToggler.removeClassByClassName('wrapper', 'scrollUpStarted', 'down');
            classToggler.removeClassByClassName('wrapper', 'scrollDownStarted', 'up');

            //window.addEventListener('load', (event) => {
            //	// (1)ページ読み込み時に一度だけスクロール量を出力
            //	var scroll_y = window.scrollY;
            //	console.log(scroll_y);
            //	// (2)スクロールするたびにスクロール量を出力
            //	window.addEventListener('scroll', (event) => {
            //		var scroll_y = window.scrollY;
            //		console.log(scroll_y);
            //	});
            //});
        </script>
        <script>
            const scriptElement = document.getElementById('script');
            scriptElement.remove();
        </script>
    </div>
</html>