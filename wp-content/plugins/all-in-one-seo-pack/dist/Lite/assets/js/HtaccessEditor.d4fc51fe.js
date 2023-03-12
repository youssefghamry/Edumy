import{a as o}from"./vuex.esm.8fdeb4b6.js";import{B as r}from"./Editor.039b9218.js";import{C as a}from"./index.cf60653e.js";import{C as n}from"./Card.72525ad5.js";import{C as i}from"./SettingsRow.edbb3005.js";import{n as c}from"./_plugin-vue2_normalizer.61652a7c.js";import"./_commonjsHelpers.f84db168.js";import"./Caret.6d7f2e24.js";import"./client.e62d6c37.js";import"./translations.c394afe3.js";import"./default-i18n.3a91e0e5.js";import"./index.3751d023.js";import"./isArrayLikeObject.cf278c5f.js";import"./helpers.de7566d0.js";import"./constants.59a77347.js";import"./portal-vue.esm.98f2e05b.js";import"./Tooltip.68a8a92b.js";import"./Slide.15a07930.js";import"./Row.830f6397.js";const l={components:{BaseEditor:r,CoreAlert:a,CoreCard:n,CoreSettingsRow:i},data(){return{strings:{htaccessEditor:this.$t.__(".htaccess Editor",this.$td),editHtaccess:this.$t.__("Edit .htaccess",this.$td),description:this.$t.sprintf(this.$t.__("This allows you to edit the .htaccess file for your site. All WordPress sites on an Apache server have a .htaccess file and we have provided you with a convenient way of editing it. Care should always be taken when editing important files from within WordPress as an incorrect change could cause WordPress to become inaccessible. %1$sBe sure to make a backup before making changes and ensure that you have FTP access to your web server and know how to access and edit files via FTP.%2$s",this.$td),"<strong>","</strong>")}}},computed:{...o(["htaccessError"])}};var d=function(){var t=this,s=t._self._c;return s("div",{staticClass:"aioseo-tools-htaccess-editor"},[s("core-card",{attrs:{slug:"htaccessEditor","header-text":t.strings.htaccessEditor}},[s("div",{staticClass:"aioseo-settings-row aioseo-section-description",domProps:{innerHTML:t._s(t.strings.description)}}),s("core-settings-row",{attrs:{name:t.strings.editHtaccess,align:""},scopedSlots:t._u([{key:"content",fn:function(){return[t.htaccessError?s("core-alert",{attrs:{type:"red"}},[t._v(" "+t._s(t.htaccessError)+" ")]):t._e(),s("base-editor",{staticClass:"htaccess-editor",attrs:{disabled:!t.$aioseo.user.unfilteredHtml,"line-numbers":"",monospace:"","preserve-whitespace":""},model:{value:t.$aioseo.data.htaccess,callback:function(e){t.$set(t.$aioseo.data,"htaccess",e)},expression:"$aioseo.data.htaccess"}})]},proxy:!0}])})],1)],1)},p=[],u=c(l,d,p,!1,null,null,null,null);const L=u.exports;export{L as default};