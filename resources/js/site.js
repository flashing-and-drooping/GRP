import lozad from 'lozad'
import morphdom from 'morphdom'
import Nanobar from 'nanobar'
import { slideDown, slideUp, isVisible } from 'slide-anim'
import { scrollTo } from 'scroll-js'
import vhCheck from 'vh-check'

let currentPath = location.pathname
const header = document.querySelector('header div:first-child')
const info = document.querySelector('.info')
const logo = document.querySelector('.logo')
const menu = document.querySelector('.menu')
const nanobar = new Nanobar({ target: document.getElementById('nanobar') })
const smallBreakpoint = getComputedStyle(document.documentElement)
    .getPropertyValue('--screen-sm')
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
function controlClickHandler(control) {
    if ('true' === control.getAttribute('data-ignore')) return

    const targetId = control.getAttribute('aria-controls')
    const target = document.getElementById(targetId)
    
    if (!target) return

    if ('true' === control.getAttribute('aria-expanded')) {
        collapse(target)
    } else {
        expand(target)

        if (target.id.startsWith('list-')) {
            // Collapse other lists
            Array.from(document.querySelectorAll('[id^="list-"]:not(#'+target.id+')'))
                .forEach(list => collapse(list))
        }
    }
}

// Smooth scrolling when clicking on menu link
function hashClickHandler(link) {
    const hash = link.getAttribute('href')
    const target = document.querySelector(hash)
    
    if (!target) return

    event.preventDefault()

    if (isMobile()) collapse(menu)

    scrollTo(document.body, { top: target.offsetTop, easing: 'ease-in-out' })
    
    history.pushState({ path: location.pathname }, null, hash)
}

// Fake private form
Array.from(document.querySelectorAll('form input'))
    .forEach(input => {
        input.addEventListener('keyup', event => {
            if (13 !== event.which) return

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
    let control = target.closest('[aria-controls]')
    if (control) controlClickHandler(control)

    // Handle hash links
    let hashLink = target.closest('li a[href^="#"]')
    if (hashLink) return hashClickHandler(hashLink)

    // Locate closest "a" element
    target = target.closest('a')
    if (target === null) return

    // Skip ignored links
    if ('true' === control.getAttribute('data-ignore')) return;
    
    // Skip external links
    if (target.host !== location.host) return
    
    // Skip media links
    if (target.pathname && target.pathname.startsWith('/media')) return
    
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
    lozad('.lozad', { rootMargin: '20px 0px', threshold: 0.1, }).observe()

    // Check vh unit
    vhCheck()
}
    
function visitHandler(path) {
    let pushState = true

    // Handle pop state event
    if ('object' === typeof path && 'popstate' === path.type) {
        path = path.state ? path.state.path : location.pathname
        pushState = false

        // Skip same path
        if (currentPath === path) return
    }
    
    load(path).then(function() {
        // Push new path to browser history
        if (pushState) window.history.pushState({ path }, '', path)
        currentPath = path
    })
}

// Stick header to the top
function calculateHeaderHeight() {
    if (isTop()) {
        expand(info).then(() => {
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