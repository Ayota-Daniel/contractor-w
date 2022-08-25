
import './styles/app.css';

const slidingNews1 = document.getElementById('etablish');
const slidingNews2 = document.getElementById('sign');
const slidingNews3 = document.getElementById('share');

window.addEventListener('scroll', () => {

    const {scrollTop, clientHeight} = document.documentElement;

    // console.log(scrollTop, clientHeight);

    const topElementToTopViewport1 = slidingNews1.getBoundingClientRect().top;
    const topElementToTopViewport2 = slidingNews2.getBoundingClientRect().top;
    const topElementToTopViewport3 = slidingNews3.getBoundingClientRect().top;


    if(scrollTop > (scrollTop + topElementToTopViewport1).toFixed() - clientHeight * 0.8){
        slidingNews1.classList.add('active');
    }
    if(scrollTop > (scrollTop + topElementToTopViewport2).toFixed() - clientHeight * 0.8){
        slidingNews2.classList.add('active');
    }
    if(scrollTop > (scrollTop + topElementToTopViewport3).toFixed() - clientHeight * 0.8){
        slidingNews3.classList.add('active');
    }
})

document.addEventListener('DOMContentLoaded', () =>{
    new App();
})

/*const slidingNewsElt = document.querySelector('slide-in');

window.addEventListener('scroll', () =>{
    const {scrollTop, clientHeight} = document.documentElement;

    const topElementToTopViewport = slidingNewsElt.getBoundingClientRect().top;

    if(scrollTop > (scrollTop + topElementToTopViewport).toFixed() - clientHeight * 0.8 ){
        slidingNewsElt.classList.add('active');
    }
});*/

class App{
    constructor(){
        this.animationAlideIn();
    }

    animationAlideIn(){
       
    }
}