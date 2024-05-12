window.onscroll = function() {scrollFunction()};
      
function scrollFunction() {
  if (document.body.scrollTop > 50 || document.documentElement.scrollTop > 50) {
    document.querySelector('.navbar').classList.add('scroll');
  } else {
    document.querySelector('.navbar').classList.remove('scroll');
  }
}