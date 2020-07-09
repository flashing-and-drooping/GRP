import lozad from 'lozad'
import morphdom from 'morphdom'
import Nanobar from 'nanobar'
import { slideDown, slideUp, isVisible } from 'slide-anim'
import { scrollTo } from 'scroll-js'

let currentHash = null
const header = document.querySelector('header div:first-child')
const info = document.querySelector('.info')
const logo = document.querySelector('.logo')
const menu = document.querySelector('.menu')
const nanobar = new Nanobar({
    target: document.getElementById('nanobar')
})
const smallBreakpoint = getComputedStyle(document.documentElement)
    .getPropertyValue('--screen')
    .replace(/\D/g, '')

calculateHeaderHeight()
loaded()
    
document.addEventListener('click', clickHandler)
window.addEventListener('popstate', visitHandler)
window.addEventListener('resize', () => isMobile() ? collapse(menu) : expand(menu))
window.addEventListener('scroll', calculateHeaderHeight, { passive: true })

// Go to the top when clicking on logo
logo.addEventListener('click', event => {
    if (!isTop()) event.preventDefault()

    scrollTo(document.body, { top: 0, easing: 'ease-in-out' })
})

// Start menu and private toggles
Array.from(document.querySelectorAll('[aria-controls]'))
    .forEach(control => {
        control.addEventListener('click', () => {
            if (control.dataset.ignore && 'true' === control.dataset.ignore) return

            const targetId = control.getAttribute('aria-controls')
            const target = document.getElementById(targetId)
            
            if (!target) return

            if ('true' === control.getAttribute('aria-expanded')) {
                collapse(target)
            } else {
                expand(target)

                if (target.id.startsWith('list-')) {
                    Array.from(document.querySelectorAll('[id^="list-"]:not(#'+target.id+')'))
                        .forEach(list => collapse(list))
                }
            }
        })
    })

// Smooth scrolling when clicking on menu link
function hashClickHandler(link) {
    const hash = link.getAttribute('href')
    const target = document.querySelector(hash)
    
    if (!target) return

    if (isMobile()) collapse(menu)

    scrollTo(document.body, { top: target.offsetTop, easing: 'ease-in-out' })
    
    event.preventDefault()
    
    setTimeout(() => location.hash = currentHash = hash, 500)
}

// Fake private form
Array.from(document.querySelectorAll('form input'))
    .forEach(input => {
        input.addEventListener('keyup', event => {
            if (event.which !== 13) return;

            Array.from(document.querySelectorAll('form input'))
                .forEach(element => element.blur())

            Array.from(document.querySelectorAll('form input, form label'))
                .forEach(element => element.classList.add('text-red'))
        })
    })

// Quick visit    
function clickHandler(e) {
    if (e.metaKey || e.shiftKey || e.ctrlKey || e.altKey || e.defaultPrevented || e.which > 1) return
    
    let target = e.target

    // Handle hash links
    let hashLink = target.closest('li a[href^="#"]')
    if (hashLink) return hashClickHandler(hashLink)

    // Locate closest "a" element
    target = target.closest('a')
    if (target === null) return

    // Skip ignored links
    if (target.dataset.ignore && 'true' === target.dataset.ignore) return;
    
    // Skip external links
    if (target && target.host !== location.host) return
    
    // Skip media links
    if (target && target.pathname.startsWith('/media')) return
    
    e.preventDefault()
    
    visitHandler(target.pathname)
}
    
function load(path) {
    nanobar.go(30)

    return fetch(path)
        .then(response => response.text())
        .then(async html => {
            nanobar.go(70)

            morphdom(
                document.body,
                (new window.DOMParser).parseFromString(html, 'text/html').body,
                {
                    onBeforeElUpdated: fromEl => fromEl.hasAttribute('data-persist') ? false : true
                }
            )
            
            scrollTo(document.body, { top: 0, easing: 'ease-in-out' })
            loaded()
            nanobar.go(100)
        })
}

function loaded() {
    // Lazyload images
    lozad('.lozad', {
        rootMargin: '20px 0px',
        threshold: 0.1,
    }).observe()
}
    
function visitHandler(path) {
    // Prevent double hash change
    if (location.hash === currentHash && 'popstate' === path.type) return

    // Handle pop state event
    if ('object' === typeof path && 'popstate' === path.type) {
        path = location.pathname
    }
    
    load(path).then(() => {
        // Push new path to browser history
        if ('string' === typeof path) window.history.pushState(null, null, path)
    })
}

// Stick header to the top
function calculateHeaderHeight() {
    if (isTop()) {
        expand(info).then(function () {
            document.documentElement.style.setProperty(
                '--header-height', header.clientHeight+'px'
            )
        })
    } else if (isVisible(info)) {
        collapse(info)
    }
}

function collapse(target) {
    const control = findControlFor(target)

    if (control) control.setAttribute('aria-expanded', 'false')

    target.setAttribute('aria-hidden', 'true')

    return slideUp(target, { display: target.dataset.display || 'block' })
}

function expand(target) {
    const control = findControlFor(target)

    if (control) control.setAttribute('aria-expanded', 'true')

    target.setAttribute('aria-hidden', 'false')

    return slideDown(target, { display: target.dataset.display || 'block' })
}

function findControlFor(target) {
    if (!target.id) return

    return document.querySelector(`[aria-controls="${target.id}"]`)
}

function isMobile() {
    return window.screen.width < smallBreakpoint
}

function isTop() {
    return window.scrollY < 10
}