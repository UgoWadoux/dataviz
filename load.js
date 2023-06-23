var loader = document.getElementById('pageLoader')
console.log(loader);

/*window.addEventListener('DOMContentLoaded',() => {
    // Faire quelque chose pour que le loader disparaissent
    loader.classList.add('hide');

})*/

setTimeout(() => {
    loader.classList.add('hide');
    console.log("Delayed for 5 second.");
}, 15000);
