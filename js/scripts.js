//Funtions
const select = (e) => document.querySelector(e);
const selectAll = (e) => document.querySelectorAll(e);
const selectWith = (p, e) => p.querySelector(e);
const selectAllWith = (p, e) => p.querySelectorAll(e);
const create = (e) => document.createElement(e);
const root = (e) => getComputedStyle(select(":root")).getPropertyValue(e);
const getStyle = (e, style) => window.getComputedStyle(e)[style];

function slider() {
    const slide = select('.slide')
    const maxSlide = 5;
    const tl = gsap.timeline();

    var currentSlide = parseInt(slide.dataset?.slide) || 1;

    currentSlide = (currentSlide % maxSlide == 0) ? 1 : currentSlide + 1;
    slide.dataset.slide = currentSlide;

    const img = create('img');
    img.src = `./assets/img/slides/slide (${currentSlide}).jpg`

    tl
        .set(img, { scale: 1.4, opacity: 0 })
        .call(() => slide.appendChild(img))
        .to(img, { scale: 1, opacity: 1, delay: 3, duration: 1.5, ease: 'Expo.easeOut' })
        .call(() => {
            slide.children[0].remove()
            slider()
        })
}

function sortNames() {
    const names = [];
    const lists = selectAll('.team-cont li')

    lists.forEach(list => names.push(list.innerText));

    names.sort((a, b) => {
        // Convert both names to lowercase for case-insensitive sorting
        const nameA = a.toLowerCase();
        const nameB = b.toLowerCase();

        // Compare the names
        if (nameA < nameB) return -1;
        if (nameA > nameB) return 1;
        return 0;
    });

    lists.forEach((list, index) => list.innerText = names[index]);
}

window.onload = () => {
    slider();
    sortNames();
};