document.addEventListener("scroll", scrollSpy);

function scrollSpy(){
    let scrollTop = document.documentElement.scrollTop;

    let documentHeight = document.documentElement.scrollHeight - document.documentElement.clientHeight;

    let pou = (scrollTop / documentHeight) * 100;

    document.querySelector(".pou").style.width = `${pou}%`;
}