//Funtions
const select = (e) => document.querySelector(e);
const selectAll = (e) => document.querySelectorAll(e);
const selectWith = (p, e) => p.querySelector(e);
const selectAllWith = (p, e) => p.querySelectorAll(e);
const create = (e) => document.createElement(e);
const root = (e) => getComputedStyle(select(":root")).getPropertyValue(e);
const getStyle = (e, style) => window.getComputedStyle(e)[style];

var newSlide = true;
const gsapScript = '../assets/libraries/gsap/gsap.min.js';
const slideStart = parseInt(select('.slide')?.dataset?.slide) || 1

//Methods
const preventDefault = (event) => event.preventDefault();
const disableLinksAndBtns = (condition = false) => {
    selectAll('a, button').forEach((element) => {
        if (condition) {
            element.setAttribute('disabled', 'true');

            if (element.tagName === 'A') {
                element.dataset.href = element.href;
                element.addEventListener('click', preventDefault);
            }
        } else {
            selectAll('a, button').forEach((element) => {
                element.removeAttribute('disabled');

                if (element.tagName === 'A') {
                    element.setAttribute('href', element.dataset.href);
                    element.removeEventListener('click', preventDefault);
                }
            });
        }
    });
}
const shuffleArray = (arr) => {
    for (let i = arr.length - 1; i > 0; i--) {
        const j = Math.floor(Math.random() * (i + 1));
        [arr[i], arr[j]] = [arr[j], arr[i]];
    }

    return arr
}

function scriptExists(src) {
    const scripts = document.getElementsByTagName('script');
    for (let i = 0; i < scripts.length; i++) {
        if (scripts[i].getAttribute('src') === src) {
            return true; // Script with the specified source exists
        }
    }
    return false; // Script does not exist
}

function fillArray(arr1, arr2) {
    if (arr1.length >= arr2.length) {
        // No need to fill, return arr1 as is
        return arr1;
    }

    // Create a copy of the original elements
    const originalElements = arr1.slice();

    // Calculate the number of additional elements needed
    const additionalElementsCount = arr2.length - arr1.length;

    // Create an array with the original elements repeated to fill the gap
    const filledArray = arr1.slice(); // Start with a copy of arr1

    // Repeatedly shuffle the original elements and add them to the filledArray
    for (let i = 0; i < additionalElementsCount; i++) {
        shuffleArray(originalElements); // Shuffle the original elements
        filledArray.push(originalElements[0]); // Add a shuffled element to the filledArray
    }

    return filledArray;
}

//Setup Page
class PageSetup {
    constructor(params = {}) {
        this.init();
    }

    init() {
        //Start Slider
        this.slider();

        //Activate Toggleable Menu
        this.appear();

        //Set Images Where Necessary
        this.setImages();

        //Change the active Menu button
        this.changeActiveMenu();

        //Highlight Search Text
        this.highlightSearch();

        //Setup Date Inputs, their min, max and all that
        this.setupDate();
    }

    //Main Functions
    slider() {
        if (!scriptExists(gsapScript)) return console.log('GSAP missing');

        const slide = select('.slide');
        if (!slide) return;

        const maxSlide = parseInt(slide.dataset?.max) || 3;
        const tl = gsap.timeline();

        var currentSlide = parseInt(slide.dataset?.slide) || 1;

        currentSlide = (currentSlide % maxSlide == 0) ? slideStart : currentSlide + 1;
        slide.dataset.slide = currentSlide;

        const img = create('img');
        img.src = `../assets/img/slides ver/slide (${currentSlide}).jpg`

        tl
            .set(img, { scale: 1.4, opacity: 0 })
            .call(() => slide.appendChild(img))
            .to(img, { opacity: 1, delay: newSlide ? 2 : 0 })
            .to(img, { scale: 1, duration: 6, ease: 'Expo.easeOut' }, '<')
            .call(() => {
                newSlide = false;
                selectWith(slide, 'img').remove();
                this.slider();
            })
    }

    appear() {
        selectAll("button:has(> appear)").forEach(e => e.addEventListener("click", toggleAppear))

        function toggleAppear() {
            const canAppear = selectWith(this, 'appear')
            const links = selectAllWith(canAppear, 'a');
            const tl = gsap.timeline();

            disableLinksAndBtns(true)

            if (getStyle(canAppear, 'display') == 'none') {
                tl
                    .set(canAppear, { display: 'block' })
                    .set(links, { xPercent: -10, opacity: 0 })
                    .to(canAppear, { y: -20, opacity: 1, ease: 'Expo.easeOut' })
                    .to(links, { xPercent: 0, opacity: 1, stagger: 0.1, ease: 'Expo.easeOut' })
                    .call(() => disableLinksAndBtns(false))
            } else {
                tl
                    .to(canAppear, { y: 0, opacity: 0, ease: 'Expo.easeOut' })
                    .set(canAppear, { display: 'none' })
                    .call(() => disableLinksAndBtns(false))
            }

        }
    }

    setImages() {
        const imgTypes = {
            'two': {
                max: 7
            },
            'four': {
                max: 4
            },
            'bi': {
                max: 4
            },
            'pe': {
                max: 10
            },
            'bus': {
                max: 3
            },
            'tr': {
                max: 3
            }
        }

        const items = selectAll('.dash-item');

        items.forEach(elem => {
            const type = elem.dataset?.type;
            for (const key in imgTypes) {
                if (type.toLowerCase().includes(key.toLowerCase())) {
                    if (imgTypes[key]?.items) imgTypes[key].items.push(elem);
                    else imgTypes[key].items = [elem];
                }
            }
        })

        for (const key in imgTypes) (imgTypes[key]?.items) ? this.assignImages(key, imgTypes[key]) : null;
    }

    assignImages(type, items = {}) {
        var empty = [];
        const max = items?.max || 1;
        const elems = items?.items || [];

        for (let i = 1; i <= max; i++) empty.push(i);

        empty = shuffleArray(empty);
        empty = fillArray(empty, elems);

        elems.forEach((e, p) => {
            const img = selectWith(e, '.dash-img');
            img.style.backgroundImage = `url('.././assets/img/vehicles/${type}\ \(${empty[p]}\).jpg`;
        })
    }

    changeActiveMenu() {
        var elem;
        const currentPage = document.body.dataset?.menu;
        if (!currentPage) return

        selectAll(".menu >*").forEach(e => {
            if (e.tagName.toLowerCase() == 'a') {
                if (e.href.toLowerCase().includes(currentPage)) elem = e
            } else {
                if (e.innerText.toLowerCase().includes(currentPage)) elem = e;
            }
        })

        if (elem) elem.classList.add('active')
        else return;
    }

    highlightSearch() {
        const search = select('.dash-result');
        const searchText = search?.dataset?.search;

        if (!searchText || searchText == 'all') return;

        const paragraphs = selectAllWith(search, 'p');

        paragraphs.forEach(elem => {
            var text = elem.innerText.toLowerCase().split(searchText);
            text = text.join(`<span>${searchText}</span>`);

            elem.style.textTransform = 'none';
            elem.innerHTML = this.capitalize(text);
            selectAllWith(elem, 'span').forEach(e => e.classList.add('highlight'));
        })
    }

    capitalize(text = '') {
        const splitText = text.split(" ");

        splitText.forEach((word, index) => {
            const hasSpan = (word.indexOf('<span>') == -1) ? null : word.indexOf('<span>');

            //Capitalize letters after space
            splitText[index] = splitText[index].charAt(0).toUpperCase() + splitText[index].slice(1);

            if (hasSpan == null) return;
            if (hasSpan == 0) splitText[index] = "<span>" + splitText[index].charAt(6).toUpperCase() + splitText[index].slice(7)
        })

        return splitText.join(" ")
    }

    setupDate() {
        const dateInputs = selectAll('input[type="date"]');
        const dashReports = selectAll('.dash-report');

        const currentDate = new Date().toISOString().split('T')[0];

        const months = [
            'January',
            'February',
            'March',
            'April',
            'May',
            'June',
            'July',
            'August',
            'September',
            'October',
            'November',
            'December'
        ]

        //Setup max for date inputs
        if (dateInputs) {
            dateInputs.forEach(e => {
                if (e.dataset?.date == 'current') e.value = currentDate;
                e.max = currentDate
            });
        }

        if (dashReports) {
            const dashReportBox = selectAll('.dash-report-box');
            dashReportBox.forEach((e, i) => (i % 2 == 0) ? null : e.classList.add('right'))

            dashReports.forEach(e => {
                const dateText = selectWith(e, 'h6');
                const defaultDate = dateText.dataset?.date;
                const dateSplit = defaultDate.split("-");

                const datePara = selectWith(e, 'p');
                const dateParaText = formatText(datePara.innerText);

                const date = `${parseInt(dateSplit[2])}, ${months[parseInt(dateSplit[1]) - 1]} ${dateSplit[0]}`

                datePara.innerHTML = dateParaText.charAt(0).toUpperCase() + dateParaText.slice(1);

                dateText.innerText = date;
            })
        }

        function formatText(text = '') {
            let counter = 0;
            let formatted = text.replace(/\|/g, () => {
                counter++
                return counter % 2 === 0 ? '"</span>' : '<span class="wine capitalize">"';
            });
            return formatted;
        }
    }
}

//Page Animations
class PageAnimations {
    constructor(params = {}) {
        Object.assign(this, params);

        this.init();
    }

    init() {
        this.type = document.body?.dataset?.menu;
        this.dash = select('.dash');

        this.fadeIn();
    }

    fadeIn() {
        const tl = gsap.timeline();
        const dashContents = selectAll('.dash>*')

        tl
            .set(dashContents, { opacity: 0 })
            .set(this.dash, { opacity: 1 })
            .to(dashContents, { opacity: 1, stagger: 0.2, delay: 0.5 })
    }
}

//Initialize Page Setup
window.onload = () => {
    new PageAnimations();
    new PageSetup();
};