
import AOS from "aos"
import "aos/dist/aos.css"

// Initialize AOS (Animate On Scroll)
document.addEventListener("DOMContentLoaded", () => {
  AOS.init({
    duration: 800,
    easing: "ease-in-out",
    once: true,
    offset: 100,
    delay: 100,
  })

  // Smooth scroll for anchor links
  document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
    anchor.addEventListener("click", function (e) {
      e.preventDefault()
      const target = document.querySelector(this.getAttribute("href"))
      if (target) {
        target.scrollIntoView({
          behavior: "smooth",
          block: "start",
        })
      }
    })
  })

  // Add scroll effect to navbar
  const navbar = document.querySelector("header")
  let lastScroll = 0

  window.addEventListener("scroll", () => {
    const currentScroll = window.pageYOffset

    if (currentScroll > 100) {
      navbar.classList.add("shadow-lg")
    } else {
      navbar.classList.remove("shadow-lg")
    }

    lastScroll = currentScroll
  })

  // Add hover effect to cards
  const cards = document.querySelectorAll(".card")
  cards.forEach((card) => {
    card.addEventListener("mouseenter", function () {
      this.style.transform = "translateY(-5px)"
    })

    card.addEventListener("mouseleave", function () {
      this.style.transform = "translateY(0)"
    })
  })
})
