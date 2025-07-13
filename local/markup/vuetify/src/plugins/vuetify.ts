/**
 * plugins/vuetify.ts
 *
 * Framework documentation: https://vuetifyjs.com`
 */

// Styles
import '@mdi/font/css/materialdesignicons.css'
import 'vuetify/styles'

import {aliases, mdi} from "vuetify/iconsets/mdi-svg";

// Composables
import {createVuetify} from 'vuetify'

// https://vuetifyjs.com/en/introduction/why-vuetify/#feature-guides
export default createVuetify({
  icons: {
    defaultSet: 'mdi',
    sets: {
      mdi
    },
    aliases: {
      ...aliases,
      invoicePlus: 'M21 13.34C20.37 13.12 19.7 13 19 13V5H5V18.26L6 17.6L9 19.6L12 17.6L13.04 18.29C13 18.5 13 18.76 13 19C13 19.65 13.1 20.28 13.3 20.86L12 20L9 22L6 20L3 22V3H21V13.34M18 15V18H15V20H18V23H20V20H23V18H20V15H18Z',
      waitDocument: 'M20 17H22V15H20V17M20 7V13H22V7M6 16H11V18H6M6 12H14V14H6M4 2C2.89 2 2 2.89 2 4V20C2 21.11 2.89 22 4 22H16C17.11 22 18 21.11 18 20V8L12 2M4 4H11V9H16V20H4Z',
      checkboxOff: 'M20,24H4c-2.2,0-4-1.8-4-4V4C0,1.8,1.8,0,4,0h16c2.2,0,4,1.8,4,4v16c0,2.2-1.8,4-4,4ZM4,1c-1.7,0-3,1.3-3,3v16c0,1.7,1.3,3,3,3h16c1.7,0,3-1.3,3-3V4c0-1.7-1.3-3-3-3H4Z',
      checkboxOn: 'M20,24H4c-2.2,0-4-1.8-4-4V4C0,1.8,1.8,0,4,0h16c2.2,0,4,1.8,4,4v16c0,2.2-1.8,4-4,4ZM4,1c-1.7,0-3,1.3-3,3v16c0,1.7,1.3,3,3,3h16c1.7,0,3-1.3,3-3V4c0-1.7-1.3-3-3-3H4ZM7,5h10c1.1,0,2,.9,2,2v10c0,1.1-.9,2-2,2H7c-1.1,0-2-.9-2-2V7c0-1.1.9-2,2-2Z',
      radioOff: 'M12,24C5.4,24,0,18.6,0,12C0,5.4,5.4,0,12,0c6.6,0,12,5.4,12,12C24,18.6,18.6,24,12,24z M12,1 C5.9,1,1,5.9,1,12s4.9,11,11,11s11-4.9,11-11S18.1,1,12,1z',
      radioOn: 'M12,24C5.4,24,0,18.6,0,12C0,5.4,5.4,0,12,0c6.6,0,12,5.4,12,12C24,18.6,18.6,24,12,24z M12,1C5.9,1,1,5.9,1,12 s4.9,11,11,11s11-4.9,11-11S18.1,1,12,1z M12,5L12,5c3.9,0,7,3.1,7,7l0,0c0,3.9-3.1,7-7,7l0,0c-3.9,0-7-3.1-7-7l0,0 C5,8.1,8.1,5,12,5z',
    }
  },
  theme: {
    defaultTheme: 'light',
  },
})
