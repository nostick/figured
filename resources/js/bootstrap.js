import axios from 'axios'
import 'bootstrap'
import Clipboard from 'clipboard'
import jquery from 'jquery'
import Echo from 'laravel-echo'
import PopperJs from 'popper.js'
import 'pusher-js'

window.$ = window.jQuery = jquery
window.PopperJs = PopperJs.default

new Clipboard('[data-clipboard-target]')

window.axios = axios
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest'

const token = document.head.querySelector('meta[name="csrf-token"]')

if (token) {
  window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content
} else {
  console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token')
}

/**
 * API Token as common header
 */

const apiToken = document.head.querySelector('meta[name="api-token"]')

if (apiToken) {
  window.axios.defaults.headers.common['Authorization'] = 'Bearer ' + apiToken.content
}
