@if(false)
<div class="relative min-h-[60vh] h-[70vh] w-full overflow-hidden"
     wire:poll.5s="nextSlide">

    @if(empty($slides))
        <div class="absolute inset-0 bg-gray-200 flex items-center justify-center">
            <div class="text-center">
                <h3 class="text-xl font-bold text-gray-600 mb-2">هیچ اسلایدی یافت نشد</h3>
                <p class="text-gray-500">لطفاً اسلایدها را در پنل ادمین اضافه کنید</p>
            </div>
        </div>
    @else
        <!-- Slides -->
        @foreach($slides as $index => $slide)
            <div class="absolute inset-0 transition-opacity duration-1000 {{ $index === $currentSlide ? 'opacity-100' : 'opacity-0' }}"
                 style="background: linear-gradient(135deg, rgba(26, 34, 67, 0.7) 0%, rgba(26, 34, 67, 0.5) 100%), url('{{ $slide['image'] }}') center/cover;">
                <div class="absolute inset-0 bg-black bg-opacity-30"></div>

                <!-- Content -->
                <div class="relative h-full flex items-center">
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full">
                        <div class="max-w-3xl {{ app()->getLocale() === 'fa' ? 'text-right' : 'text-left' }}">
                            <h2 class="text-3xl lg:text-5xl font-bold text-white mb-3 animate-slide-up">
                                {{ $slide['title'] }}
                            </h2>
                            <p class="text-lg lg:text-xl text-white/90 mb-4 animate-slide-up" style="animation-delay: 0.2s;">
                                {{ $slide['subtitle'] }}
                            </p>
                            <p class="text-base text-white/80 mb-6 animate-slide-up" style="animation-delay: 0.4s;">
                                {{ $slide['description'] }}
                            </p>
                            <a href="{{ $slide['cta_link'] }}"
                               class="inline-flex items-center px-6 py-3 bg-accent text-primary font-semibold rounded-lg hover:bg-accent/90 transition-all duration-300 transform hover:scale-105 animate-slide-up"
                               style="animation-delay: 0.6s;">
                                {{ $slide['cta_text'] }}
                                <i class="fas fa-arrow-{{ app()->getLocale() === 'fa' ? 'left' : 'right' }} {{ app()->getLocale() === 'fa' ? 'mr-2' : 'ml-2' }}"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

        <!-- Control Buttons Group -->
        <div class="absolute top-4 {{ app()->getLocale() === 'fa' ? 'left-4' : 'right-4' }} flex items-center space-x-2 {{ app()->getLocale() === 'fa' ? 'space-x-reverse' : '' }} z-10">
            <!-- Previous Button -->
            <button wire:click="prevSlide" wire:loading.attr="disabled"
                    class="bg-white/20 hover:bg-white/30 text-white p-1.5 rounded-full transition-all duration-300 backdrop-blur-sm disabled:opacity-50 disabled:cursor-not-allowed">
                <i class="fas fa-chevron-{{ app()->getLocale() === 'fa' ? 'right' : 'left' }} text-sm"></i>
            </button>

            <!-- Pause/Play Button -->
            <button wire:click="toggleAutoSlide"
                    class="bg-white/20 hover:bg-white/30 text-white p-1.5 rounded-full transition-all duration-300 backdrop-blur-sm">
                <i class="fas {{ $autoSlide ? 'fa-pause' : 'fa-play' }} text-sm"></i>
            </button>

            <!-- Next Button -->
            <button wire:click="nextSlide" wire:loading.attr="disabled"
                    class="bg-white/20 hover:bg-white/30 text-white p-1.5 rounded-full transition-all duration-300 backdrop-blur-sm disabled:opacity-50 disabled:cursor-not-allowed">
                <i class="fas fa-chevron-{{ app()->getLocale() === 'fa' ? 'left' : 'right' }} text-sm"></i>
            </button>
        </div>

        <!-- Dots Indicator -->
        <div class="absolute bottom-4 left-1/2 transform -translate-x-1/2 flex {{ app()->getLocale() === 'fa' ? 'space-x-reverse space-x-2' : 'space-x-2' }} z-10">
            @foreach($slides as $index => $slide)
                <button wire:click="goToSlide({{ $index }})" wire:loading.attr="disabled"
                        class="w-3 h-3 rounded-full transition-all duration-300 {{ $index === $currentSlide ? 'bg-accent' : 'bg-white/50 hover:bg-white/70' }} disabled:opacity-50 disabled:cursor-not-allowed">
                </button>
            @endforeach
        </div>
    @endif
    </div>
@endif

<div id="hero3d" class="relative w-full overflow-hidden">
    <style>
        /* Scoped variables and base */
        #hero3d{--item1-transform:translateX(-100%) translateY(-5%) scale(1.5);--item1-filter:blur(35px);--item1-zIndex:11;--item1-opacity:0;--item2-transform:translateX(0);--item2-filter:blur(0px);--item2-zIndex:10;--item2-opacity:1;--item3-transform:translate(65%,12%) scale(0.8);--item3-filter:blur(24px);--item3-zIndex:9;--item3-opacity:1;--item4-transform:translate(110%,22%) scale(0.5);--item4-filter:blur(40px);--item4-zIndex:8;--item4-opacity:1;--item5-transform:translate(145%,32%) scale(0.3);--item5-filter:blur(60px);--item5-zIndex:7;--item5-opacity:0}
        #hero3d .carousel{position:relative;height:720px;overflow:hidden;background: transparent}
        #hero3d .carousel .list{position:absolute;width:1140px;max-width:90%;height:80%;left:50%;transform:translateX(-50%)}
        #hero3d .carousel .list .item{position:absolute;left:0%;width:70%;height:100%;font-size:15px;transition:left .5s,opacity .5s,width .5s}
        #hero3d .carousel .list .item:nth-child(n + 6){opacity:0}
        #hero3d .carousel .list .item:nth-child(2){z-index:10;transform:translateX(0);width:100%}
        #hero3d .carousel .list .item img{width:50%;position:absolute;left:50%;top:50%;transform:translate(-50%,-50%) scale(2.1);transition:left 1.5s,transform 1.5s}
        #hero3d .carousel .list .item .introduce{opacity:0;pointer-events:none}
        #hero3d .carousel .list .item:nth-child(2) .introduce{opacity:1;pointer-events:auto;width:min(90%,640px);position:absolute;top:50px;right:16px;left:auto;bottom:auto;transform:none;text-align:right;z-index:20;padding-right:12px;transition:opacity .5s}
        #hero3d .carousel .list .item .introduce .title{font-size:2em;font-weight:500;line-height:1em}
        #hero3d .carousel .list .item .introduce .topic{font-size:4em;font-weight:500}
        #hero3d .carousel .list .item .introduce .des{font-size:small;color:#5559}
        #hero3d .carousel .list .item .introduce .seeMore{margin-top:1.2em;padding:5px 0;border:none;border-bottom:1px solid #555;background-color:transparent;font-weight:bold;letter-spacing:3px;transition:background .5s}
        #hero3d .carousel .list .item .introduce .seeMore:hover{background:#eee}
        #hero3d .carousel .list .item:nth-child(1){transform:var(--item1-transform);filter:var(--item1-filter);z-index:var(--item1-zIndex);opacity:var(--item1-opacity);pointer-events:none}
        #hero3d .carousel .list .item:nth-child(3){transform:var(--item3-transform);filter:var(--item3-filter);z-index:var(--item3-zIndex)}
        #hero3d .carousel .list .item:nth-child(4){transform:var(--item4-transform);filter:var(--item4-filter);z-index:var(--item4-zIndex)}
        #hero3d .carousel .list .item:nth-child(5){transform:var(--item5-transform);filter:var(--item5-filter);opacity:var(--item5-opacity);pointer-events:none}
        #hero3d .carousel .list .item:nth-child(2) .introduce .title,
        #hero3d .carousel .list .item:nth-child(2) .introduce .topic,
        #hero3d .carousel .list .item:nth-child(2) .introduce .des,
        #hero3d .carousel .list .item:nth-child(2) .introduce .seeMore{opacity:0;animation:hero3d-showContent .5s 1s ease-in-out 1 forwards}
        @keyframes hero3d-showContent{from{transform:translateY(-30px);filter:blur(10px)}to{transform:translateY(0);opacity:1;filter:blur(0px)}}
        #hero3d .carousel .list .item:nth-child(2) .introduce .topic{animation-delay:1.2s}
        #hero3d .carousel .list .item:nth-child(2) .introduce .des{animation-delay:1.4s}
        #hero3d .carousel .list .item:nth-child(2) .introduce .seeMore{animation-delay:1.6s}
        #hero3d .carousel.next .item:nth-child(1){animation:hero3d-fromPos2 .5s ease-in-out 1 forwards}
        @keyframes hero3d-fromPos2{from{transform:var(--item2-transform);filter:var(--item2-filter);opacity:var(--item2-opacity)}}
        #hero3d .carousel.next .item:nth-child(2){animation:hero3d-fromPos3 .7s ease-in-out 1 forwards}
        @keyframes hero3d-fromPos3{from{transform:var(--item3-transform);filter:var(--item3-filter);opacity:var(--item3-opacity)}}
        #hero3d .carousel.next .item:nth-child(3){animation:hero3d-fromPos4 .9s ease-in-out 1 forwards}
        @keyframes hero3d-fromPos4{from{transform:var(--item4-transform);filter:var(--item4-filter);opacity:var(--item4-opacity)}}
        #hero3d .carousel.next .item:nth-child(4){animation:hero3d-fromPos5 1.1s ease-in-out 1 forwards}
        @keyframes hero3d-fromPos5{from{transform:var(--item5-transform);filter:var(--item5-filter);opacity:var(--item5-opacity)}}
        #hero3d .carousel.prev .list .item:nth-child(5){animation:hero3d-fromPos4 .5s ease-in-out 1 forwards}
        #hero3d .carousel.prev .list .item:nth-child(4){animation:hero3d-fromPos3 .7s ease-in-out 1 forwards}
        #hero3d .carousel.prev .list .item:nth-child(3){animation:hero3d-fromPos2 .9s ease-in-out 1 forwards}
        #hero3d .carousel.prev .list .item:nth-child(2){animation:hero3d-fromPos1 1.1s ease-in-out 1 forwards}
        @keyframes hero3d-fromPos1{from{transform:var(--item1-transform);filter:var(--item1-filter);opacity:var(--item1-opacity)}}
        #hero3d .carousel .list .item .detail{opacity:0;pointer-events:none}
        #hero3d .carousel.showDetail .list .item:nth-child(3),
        #hero3d .carousel.showDetail .list .item:nth-child(4){left:100%;opacity:0;pointer-events:none}
        #hero3d .carousel.showDetail .list .item:nth-child(2){width:100%}
        #hero3d .carousel.showDetail .list .item:nth-child(2) .introduce{opacity:0;pointer-events:none}
        #hero3d .carousel.showDetail .list .item:nth-child(2) img{left:50%}
        #hero3d .carousel.showDetail .list .item:nth-child(2) .detail{opacity:1;width:50%;position:absolute;left:0;top:50%;transform:translateY(-50%);text-align:left;pointer-events:auto}
        #hero3d .carousel.showDetail .list .item:nth-child(2) .detail .title{font-size:4em}
        #hero3d .carousel.showDetail .list .item:nth-child(2) .detail .specifications{display:flex;gap:10px;width:100%;border-top:1px solid #5553;margin-top:20px}
        #hero3d .carousel.showDetail .list .item:nth-child(2) .detail .specifications div{width:90px;text-align:center;flex-shrink:0}
        #hero3d .carousel.showDetail .list .item:nth-child(2) .detail .specifications div p:nth-child(1){font-weight:bold}
        #hero3d .carousel.carousel.showDetail .list .item:nth-child(2) .checkout button{background-color:transparent;border:1px solid #5555;margin-left:5px;padding:5px 10px;letter-spacing:2px;font-weight:500}
        #hero3d .carousel.carousel.showDetail .list .item:nth-child(2) .checkout button:nth-child(2){background-color:#693EFF;color:#eee}
        #hero3d .carousel.showDetail .list .item:nth-child(2) .detail .title,
        #hero3d .carousel.showDetail .list .item:nth-child(2) .detail .des,
        #hero3d .carousel.showDetail .list .item:nth-child(2) .detail .specifications,
        #hero3d .carousel.showDetail .list .item:nth-child(2) .detail .checkout{opacity:0;animation:hero3d-showContent .5s 1s ease-in-out 1 forwards}
        #hero3d .carousel.showDetail .list .item:nth-child(2) .detail .des{animation-delay:1.2s}
        #hero3d .carousel.showDetail .list .item:nth-child(2) .detail .specifications{animation-delay:1.4s}
        #hero3d .carousel.showDetail .list .item:nth-child(2) .detail .checkout{animation-delay:1.6s}
        #hero3d .arrows{position:absolute;bottom:10px;width:1140px;max-width:90%;display:flex;justify-content:space-between;left:50%;transform:translateX(-50%)}
        #hero3d #prev,#hero3d #next{width:40px;height:40px;border-radius:50%;border:1px solid #5555;font-size:large}
        #hero3d #back{position:absolute;z-index:100;bottom:0%;left:50%;transform:translateX(-50%);border:none;border-bottom:1px solid #555;font-weight:bold;letter-spacing:3px;background-color:transparent;padding:10px;transition:opacity .5s}
        #hero3d .carousel.showDetail #back{opacity:1}
        #hero3d .carousel.showDetail #prev,#hero3d .carousel.showDetail #next{opacity:0;pointer-events:none}
        #hero3d .carousel::before{content:"";position:absolute;inset:0;background: url("/images/Mask group.png") center top / cover no-repeat;z-index:-1;filter:none;border-radius:0}
        #hero3d .carousel.showDetail::before{transform:none;filter:none}
        @media screen and (max-width:991px){#hero3d .carousel{height:620px}#hero3d .carousel .list .item{width:90%}#hero3d .carousel.showDetail .list .item:nth-child(2) .detail .specifications{overflow:auto}#hero3d .carousel.showDetail .list .item:nth-child(2) .detail .title{font-size:2em}}
        @media screen and (max-width:767px){#hero3d .carousel{height:520px}#hero3d .carousel .list .item{width:100%;font-size:10px}#hero3d .carousel .list{height:100%}#hero3d .carousel .list .item:nth-child(2) .introduce{width:92%;top:24px;right:12px;left:auto;bottom:auto;transform:none;text-align:right;padding-right:8px}#hero3d .carousel .list .item img{width:40%}#hero3d .carousel.showDetail .list .item:nth-child(2) .detail{backdrop-filter:blur(10px);font-size:small}#hero3d .carousel .list .item:nth-child(2) .introduce .des,#hero3d .carousel.showDetail .list .item:nth-child(2)
        .detail .des{height:100px;overflow:auto}#hero3d .carousel.showDetail .list .item:nth-child(2) .detail .checkout{display:flex;width:max-content;float:right}}
    </style>

    <div class="carousel">
        <div class="list">
            <div class="item">
                <img src="{{ asset('storage/slider/slide01.png') }}" alt="خودرو ۱">
                <div class="introduce">
                    <div class="topic">خودرو لوکس</div>
                    <div class="des">قدرت، زیبایی و فناوری در کنار هم برای یک رانندگی متفاوت.</div>
                    <button class="seeMore">مشاهده بیشتر &#8599;</button>
                </div>
            </div>

            <div class="item">
                <img src="{{ asset('storage/slider/slide02.png') }}" alt="خودرو ۲">
                <div class="introduce">
                    <div class="topic">SUV اسپرت</div>
                    <div class="des">آماده برای هر مسیر؛ از شهر تا آفرود با راحتی کامل.</div>
                    <button class="seeMore">مشاهده بیشتر &#8599;</button>
                </div>
            </div>

            <div class="item">
                <img src="{{ asset('storage/slider/slide03.png') }}" alt="خودرو ۳">
                <div class="introduce">
                    <div class="topic">سدان پریمیوم</div>
                    <div class="des">سیستم‌های کمکی رانندگی و سرگرمی مدرن در کابینی مینیمال.</div>
                    <button class="seeMore">مشاهده بیشتر &#8599;</button>
                </div>
            </div>
        </div>

        <div class="arrows">
            <button id="prev"><</button>
            <button id="next">></button>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function(){
            const root = document.getElementById('hero3d');
            if(!root) return;
            const nextButton = root.querySelector('#next');
            const prevButton = root.querySelector('#prev');
            const carousel = root.querySelector('.carousel');
            const listHTML = root.querySelector('.carousel .list');
            const seeMoreButtons = root.querySelectorAll('.seeMore');
            const backButton = root.querySelector('#back');

            const showSlider = (type) => {
                if(!nextButton || !prevButton || !carousel || !listHTML) return;
                nextButton.style.pointerEvents = 'none';
                prevButton.style.pointerEvents = 'none';
                carousel.classList.remove('next','prev');
                const items = root.querySelectorAll('.carousel .list .item');
                if(type === 'next'){
                    listHTML.appendChild(items[0]);
                    carousel.classList.add('next');
                } else {
                    listHTML.prepend(items[items.length - 1]);
                    carousel.classList.add('prev');
                }
                setTimeout(()=>{
                    nextButton.style.pointerEvents = 'auto';
                    prevButton.style.pointerEvents = 'auto';
                }, 4000);
            };

            if(nextButton){ nextButton.addEventListener('click', ()=>showSlider('next')); }
            if(prevButton){ prevButton.addEventListener('click', ()=>showSlider('prev')); }
            seeMoreButtons.forEach(btn => btn.addEventListener('click', ()=>{
                if(!carousel) return;
                carousel.classList.remove('next','prev');
                carousel.classList.add('showDetail');
            }));
            if(backButton){ backButton.addEventListener('click', ()=>carousel && carousel.classList.remove('showDetail')); }

            // Auto play every 5 seconds; pause while showing details
            setInterval(()=>{
                if(!carousel || carousel.classList.contains('showDetail')) return;
                showSlider('next');
            }, 5000);
        });
    </script>
</div>
