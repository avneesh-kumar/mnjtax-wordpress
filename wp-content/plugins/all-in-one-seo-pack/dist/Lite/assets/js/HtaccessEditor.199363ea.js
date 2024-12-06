import{b as _,u as f}from"./index.5a710757.js";import{B as h}from"./Editor.e5877fb8.js";import{C as g}from"./Caret.662da1f3.js";import{C as y}from"./Card.5b602127.js";import{C as w}from"./SettingsRow.1934f141.js";import"./translations.12335a6a.js";import{_ as b}from"./_plugin-vue_export-helper.249dac1d.js";import{_ as s,s as v}from"./default-i18n.54b5d8cd.js";import{c as C,C as r,l as n,v as o,o as c,a as k,k as x,x as S,t as E,b as B}from"./runtime-dom.esm-bundler.6789c400.js";import"./helpers.f95d5840.js";import"./isEqual.51bf23f5.js";import"./_baseIsEqual.6bc92395.js";import"./_getTag.8dc22eac.js";import"./_baseClone.50c6045c.js";import"./_arrayEach.f4f00336.js";import"./index.ee8124c6.js";import"./Tooltip.b6b45c85.js";import"./Slide.d0517fb0.js";import"./Row.f01f32cd.js";const a="all-in-one-seo-pack",V={setup(){return{optionsStore:_(),rootStore:f()}},components:{BaseEditor:h,CoreAlert:g,CoreCard:y,CoreSettingsRow:w},data(){return{strings:{htaccessEditor:s(".htaccess Editor",a),editHtaccess:s("Edit .htaccess",a),description:v(s("This allows you to edit the .htaccess file for your site. All WordPress sites on an Apache server have a .htaccess file and we have provided you with a convenient way of editing it. Care should always be taken when editing important files from within WordPress as an incorrect change could cause WordPress to become inaccessible. %1$sBe sure to make a backup before making changes and ensure that you have FTP access to your web server and know how to access and edit files via FTP.%2$s",a),"<strong>","</strong>")}}}},A={class:"aioseo-tools-htaccess-editor"},H=["innerHTML"];function P(T,i,L,e,t,N){const l=o("core-alert"),d=o("base-editor"),p=o("core-settings-row"),m=o("core-card");return c(),C("div",A,[r(m,{slug:"htaccessEditor","header-text":t.strings.htaccessEditor},{default:n(()=>[k("div",{class:"aioseo-settings-row aioseo-section-description",innerHTML:t.strings.description},null,8,H),r(p,{name:t.strings.editHtaccess,align:""},{content:n(()=>[e.optionsStore.htaccessError?(c(),x(l,{key:0,type:"red"},{default:n(()=>[S(E(e.optionsStore.htaccessError),1)]),_:1})):B("",!0),r(d,{class:"htaccess-editor",disabled:!e.rootStore.aioseo.user.unfilteredHtml,modelValue:e.rootStore.aioseo.data.htaccess,"onUpdate:modelValue":i[0]||(i[0]=u=>e.rootStore.aioseo.data.htaccess=u),"line-numbers":"",monospace:"","preserve-whitespace":""},null,8,["disabled","modelValue"])]),_:1},8,["name"])]),_:1},8,["header-text"])])}const ee=b(V,[["render",P]]);export{ee as default};
