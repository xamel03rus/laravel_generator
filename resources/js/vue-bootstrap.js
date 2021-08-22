/**
 * Vue with components
 */
import Vue from './components/index'

/**
 * Vue plugins
 */
import YmapPlugin from 'vue-yandex-maps'
import VueDadata from 'vue-dadata'
import { BootstrapVue, IconsPlugin, BVToastPlugin } from 'bootstrap-vue'
import VueToast from 'vue-toast-notification'
import moment from 'moment'

/**
 * Helper functions
 */
import { link } from './helpers'
import * as helper from './helpers'
import { saveAs } from 'file-saver'

/**
 * CSS Styles
 */
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'
import 'vue-toast-notification/dist/theme-default.css'
import 'vue2-dropzone/dist/vue2Dropzone.min.css'

window.Vue = Vue

const settings = {
    apiKey: '951b88bf-6e47-44b2-8fa1-b7b0d39dd6f9',
    lang: 'ru_RU',
    coordorder: 'latlong',
    version: '2.1'
}

/**
 * Vue plugins
 */

Vue.use(BVToastPlugin)
Vue.use(YmapPlugin, settings)
Vue.use(VueDadata)
Vue.use(VueToast)
Vue.use(BootstrapVue)
Vue.use(IconsPlugin)

/**
 * Helper functionctions
 */
Vue.prototype.$saveAs = saveAs
Vue.prototype.link = link
Vue.prototype.$helper = helper
Vue.prototype.$axios = axios
Vue.prototype.$moment = moment
Vue.prototype.$tokenGet = () => {
    return localStorage.getItem('token')
}
Vue.prototype.$tokenSet = (token) => {
    return localStorage.setItem('token', token)
}
Vue.prototype.$tokenRemove = () => {
    return localStorage.removeItem('token')
}
Vue.prototype.$prepareAxiosResponse = async function (promise) {
    try {
        const response = await promise
        const {data: responseData} = response
        if (responseData.success) {
            const {message: {title, description}} = responseData.success
            this.$toast.open(`
                <b>${title}: </b>${description}
            `)
        }
        return response;
    } catch (responseError) {
        try {
            const {response: {data: {error: {message: {description, title}, fields}}}} = responseError
            this.$toast.error(
                `
                    <b>${title}: </b>${description}<br/>Поля с ошибками: <br/><pre>${fields ? Object.keys(fields).join('<br/>') : ''}</pre>
                `
            )
        } catch (toastError) {
            this.$toast.error(responseError.response.data.message)
        }
        throw responseError
    }
}

export default Vue