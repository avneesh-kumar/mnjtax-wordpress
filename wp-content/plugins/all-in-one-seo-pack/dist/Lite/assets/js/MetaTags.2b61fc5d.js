import{b as r}from"./index.5a710757.js";const s=o=>{const t=document.createElement("div");return t.innerHTML=o,t.firstChild},c=()=>({maybeUpdateId:t=>{const e=r(),n=s(e.options.webmasterTools[t]);n instanceof HTMLElement&&n.nodeName==="META"&&n.getAttribute("content").length&&(e.options.webmasterTools[t]=n.getAttribute("content"))}});export{c as u};
