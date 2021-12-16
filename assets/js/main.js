// Calls custom functions after page- and content-load
window.onload = function () {
  let btn = document.querySelector(".post-btn")
  let single_btn = document.getElementById("go-back")

  function checkAllBtns() {
    if (btn != null) {
      btn.addEventListener("click", () => {
        btn.blur()
      })
    } else {
      return
    }
  }

  function checkSingleBtn() {
    if (single_btn != null) {
      single_btn.addEventListener("click", () => {
        history.back()
      })
    } else {
      return
    }
  }

  checkAllBtns()
  checkSingleBtn()

  // Gets window size of client and runs custom scripts
  // depending on client-width
  function getWindowSize() {
    let w = document.documentElement.clientWidth
    let animated_img = document.getElementById("animated-img")

    if (animated_img != null) {
      animated_img.style.maxWidth = "345px"
      if (w >= 1200) {
        gsap.to("img.animated-img", { duration: 1, x: "10%" })
        gsap.fromTo(
          ".animated-text-container",
          { x: "30%" },
          { x: "-3%", duration: 2 }
        )
      } else if (w >= 960) {
        gsap.to("img.animated-img", { duration: 1, x: "10%" })
        gsap.fromTo(
          ".animated-text-container",
          { x: "30%" },
          { x: "-5%", duration: 2 }
        )
      } else {
        animated_img.classList.add("w-50")
      }
    } else {
      return
    }
  }

  window.addEventListener("resize", getWindowSize)
  getWindowSize()
}

let scrollToTopBtn = document.querySelector(".scrollToTopBtn")
let rootElement = document.documentElement

// Sets a scroll-button for going up to the menu
function handleScroll() {
  let scrollTotal = rootElement.scrollHeight - rootElement.clientHeight
  if (rootElement.scrollTop / scrollTotal > 0.5) {
    // Show button
    scrollToTopBtn.classList.add("showBtn")
  } else {
    // Hide button
    scrollToTopBtn.classList.remove("showBtn")
  }
}
// Function for scrolling to top
function scrollToTop() {
  // Scroll to top logic
  rootElement.scrollTo({
    top: 0,
    behavior: "smooth",
  })
  scrollToTopBtn.blur()
}

scrollToTopBtn.addEventListener("click", scrollToTop)
document.addEventListener("scroll", handleScroll)

// Resets scroll to top when refreshing page
if (history.scrollRestoration) {
  history.scrollRestoration = "manual"
} else {
  window.onbeforeunload = function () {
    window.scrollTo(0, 0)
  }
}
