window.addEventListener("load", function() {
    const menu = document.querySelector(".bar-responsive");
    const menuContentTop = document.querySelector(".menu-content-top");
    const menuLeftItems = [...document.querySelectorAll(".mn-left li a")];
    const menuRightItems = [...document.querySelectorAll(".mn-right li a")];

    menu.addEventListener("click", (event) => {
        menuContentTop.classList.toggle("active");
        if(event.target.classList.contains("fa-bars")) {
            event.target.classList.toggle("fa-xmark");
        } else {
            event.target.classList.toggle("fa-bars");
        }
    });

    document.addEventListener("click", function(e) {
        if(!menuContentTop.classList.contains(e.target) && !e.target.matches(".bar-responsive")) {
            menuContentTop.classList.remove("active");
            if(menu.classList.contains("fa-xmark")) {
                menu.classList.toggle("fa-xmark");
            }
        }
    });

    window.addEventListener("scroll", function(e) {
        const scrollTop = window.pageYOffset;
        if(scrollTop > 0) {
            menu.style.display = "none";
        } else {
            menu.style.display = "block";
        }
    });

    menuLeftItems.forEach(item => item.addEventListener("mouseenter", handleHoverMouseTooltip))
    function handleHoverMouseTooltip(e) {
        const span = document.createElement("span");
        span.className = "tooltip-name";
        span.textContent = `${e.target.dataset.tooltip}`;
        document.body.appendChild(span);
        let tooltipName = document.querySelector(".tooltip-name");
        const cor = e.target.getBoundingClientRect();
        let {width, height, top, left, right} = cor;
        let x = left + width/3;
        let y = top-height;
        tooltipName.style.left = `${x}px`;
        tooltipName.style.top = `${y}px`;
        if(tooltipName) {
            setTimeout(function() {
                tooltipName.parentNode.removeChild(tooltipName);
            },500);
        }
    }
    menuRightItems.forEach(item => item.addEventListener("mouseenter", handleHoverMouseTooltipRight))
    function handleHoverMouseTooltipRight(e) {
        const span = document.createElement("span");
        span.className = "tooltip-name-right";
        span.textContent = `${e.target.dataset.hot}`;
        document.body.appendChild(span);
        let tooltipName = document.querySelector(".tooltip-name-right");
        const cor = e.target.getBoundingClientRect();
        let {width, height, top, left, right} = cor;
        let x = left + width/3;
        let y = top-height;
        tooltipName.style.left = `${x}px`;
        tooltipName.style.top = `${y}px`;
        if(tooltipName) {
            setTimeout(function() {
                tooltipName.parentNode.removeChild(tooltipName);
            },500);
        }
    }

    const teamplate = `<div class="modal">
        <div class="modal-overlay"></div>
        <div class="modal-content">
        <span class="modal-close">
            <i class="fa-solid fa-xmark close"></i>
        </span>
        <div class="modal-main">
            Chào mừng bạn đã đến với Market Shop!
            <h3>Hiện tại shop đang giảm giá 20% tất cả các mặt hàng. Liên hệ với chúng tôi để biết ngay chi tiết: 0339355715!</h3>
        </div>
        </div>
    </div>`;
    document.body.insertAdjacentHTML("afterbegin", teamplate);
    const modalAlert = document.querySelector(".modal");

    if(modalAlert) {
        setTimeout(() => {
            modalAlert.classList.add("show");
        }, 2000);
    }

    document.body.addEventListener("click", function(e) {
        if(e.target.matches(".close")) {
            let modal =  e.target.parentElement.parentElement.parentElement;
            modal.parentElement.removeChild(modal);
        } else if(e.target.matches('.modal-overlay')) {
            let md = e.target.parentElement;
            md.parentElement.removeChild(md);
        }
    });

    document.body.addEventListener("keydown", function(e) {
        if(e.key === "Escape") {
            if(modalAlert) {
                modalAlert.parentElement.removeChild(modalAlert);
            }
        }
    });


    const socials = [...document.querySelectorAll(".social-item")];
    socials.forEach(item => item.addEventListener("mouseenter", handleHoverSocial));
    function handleHoverSocial(e) {
        const colors = ["#3b5998", "#00aced", "#dd4b39", "#000000ad", "#007bb7", "#bb0000"];
        const divTooltipSocial = document.createElement("div");
        divTooltipSocial.className = `tootip-social-${e.target.dataset.social}`;
        divTooltipSocial.textContent = e.target.dataset.social;
        document.body.appendChild(divTooltipSocial);
        let tooltipSoc = document.querySelector(`.tootip-social-${e.target.dataset.social}`);
        const {left, width, height, top} = e.target.getBoundingClientRect();
            tooltipSoc.style.left = `${left-width/2}px`;
            tooltipSoc.style.top = `${top - height - 4}px`;
            if( e.target.dataset.social === "facebook") {
                tooltipSoc.style.background = colors[0];
            } else if(e.target.dataset.social === "twitter") {
                tooltipSoc.style.background = colors[1];
            } else if(e.target.dataset.social === "google") {
                tooltipSoc.style.background = colors[2];
            }  else if(e.target.dataset.social === "github") {
                tooltipSoc.style.background = colors[3];
            } else if(e.target.dataset.social === "instagram") {
                tooltipSoc.style.background = colors[4];
            } else if(e.target.dataset.social === "youtube") {
                tooltipSoc.style.background = colors[5];
            }
            if(tooltipSoc) {
                setTimeout(function() {
                    tooltipSoc.parentNode.removeChild(tooltipSoc);
                },1350);
            } 
    }

    // COUNT DOWN TIMER DEAL
    const textDays = document.querySelector(".days");
    const textHours = document.querySelector(".hours");
    const textMinutes = document.querySelector(".minutes");
    const textSeconds = document.querySelector(".seconds");
    const closeDealCountDown = document.querySelector(".close-deal");

    closeDealCountDown.addEventListener("click", function(e) {
        if(e.target.matches(".close-deal")) {
            const counterSale = e.target.parentElement;
            counterSale.parentElement.removeChild(counterSale);
        }
    })


    // Mon Nov 07 2022 14:04:17 GMT+0700 (Indochina Time)   
    // Mon May 07 2023 14:04:17 GMT+0700 (Indochina Time)   
    function countDown(date) {
        if(date) {
            let days, hours, minutes, seconds;
            const now = new Date();
            const timeNow = now.getTime();
            const willTime = new Date(date).getTime();
            let timeRemaining = parseInt((willTime - timeNow) / 1000);
            // console.log(timeRemaining);
            // day = 24 *60 *60 = 86400
            // hour = 60* 60 = 3600
            // minute = 60
            // second = 1
            days = parseInt(timeRemaining / 86400);
            timeRemaining = timeRemaining % 86400;
            hours = parseInt(timeRemaining / 3600);
            timeRemaining  = timeRemaining % 3600;
            minutes = parseInt(timeRemaining / 60);
            timeRemaining = timeRemaining % 60;
            seconds = parseInt(timeRemaining)
            textDays.textContent = days;
            textHours.textContent = hours;
            textMinutes.textContent = minutes;
            textSeconds.textContent = seconds;
        } else {
            return;
        }
    }

    setInterval(function() {
        countDown("Mon May 07 2023 14:04:17 GMT+0700 (Indochina Time)");
    }, 1000);

    const counterSale = document.querySelector(".counter-sale");
    const titleSale = document.querySelector(".title-sale");
    titleSale.addEventListener("click", function() {
        counterSale.classList.add("active");
    });

    document.body.addEventListener("keydown", function(e) {
        if(e.key === "Escape") {
            if(counterSale) {
                counterSale.parentElement.removeChild(counterSale);
            }
        }
    });
    // Keydown Event with Count Down timer
    
    
    
});
