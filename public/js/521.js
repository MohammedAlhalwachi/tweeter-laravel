(self.webpackChunk=self.webpackChunk||[]).push([[521],{1027:(e,t,s)=>{"use strict";s.d(t,{Z:()=>r});const n={props:["on"]};const r=(0,s(1900).Z)(n,(function(){var e=this,t=e.$createElement,s=e._self._c||t;return s("div",[s("transition",{attrs:{"leave-active-class":"transition ease-in duration-1000","leave-class":"opacity-100","leave-to-class":"opacity-0"}},[s("div",{directives:[{name:"show",rawName:"v-show",value:e.on,expression:"on"}],staticClass:"text-sm text-gray-600"},[e._t("default")],2)])],1)}),[],!1,null,null,null).exports},4359:(e,t,s)=>{"use strict";s.d(t,{Z:()=>r});const n={props:{type:{type:String,default:"submit"}}};const r=(0,s(1900).Z)(n,(function(){var e=this,t=e.$createElement;return(e._self._c||t)("button",{staticClass:"inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray transition ease-in-out duration-150",attrs:{type:e.type}},[e._t("default")],2)}),[],!1,null,null,null).exports},3292:(e,t,s)=>{"use strict";s.d(t,{Z:()=>r});const n={components:{JetSectionTitle:s(4459).Z},computed:{hasActions:function(){return!!this.$slots.actions}}};const r=(0,s(1900).Z)(n,(function(){var e=this,t=e.$createElement,s=e._self._c||t;return s("div",{staticClass:"md:grid md:grid-cols-3 md:gap-6"},[s("jet-section-title",{scopedSlots:e._u([{key:"title",fn:function(){return[e._t("title")]},proxy:!0},{key:"description",fn:function(){return[e._t("description")]},proxy:!0}],null,!0)}),e._v(" "),s("div",{staticClass:"mt-5 md:mt-0 md:col-span-2"},[s("form",{on:{submit:function(t){return t.preventDefault(),e.$emit("submitted")}}},[s("div",{staticClass:"shadow overflow-hidden sm:rounded-md"},[s("div",{staticClass:"px-4 py-5 bg-white sm:p-6"},[s("div",{staticClass:"grid grid-cols-6 gap-6"},[e._t("form")],2)]),e._v(" "),e.hasActions?s("div",{staticClass:"flex items-center justify-end px-4 py-3 bg-gray-50 text-right sm:px-6"},[e._t("actions")],2):e._e()])])])],1)}),[],!1,null,null,null).exports},5659:(e,t,s)=>{"use strict";s.d(t,{Z:()=>r});const n={props:["value"],methods:{focus:function(){this.$refs.input.focus()}}};const r=(0,s(1900).Z)(n,(function(){var e=this,t=e.$createElement;return(e._self._c||t)("input",{ref:"input",staticClass:"form-input rounded-md shadow-sm",domProps:{value:e.value},on:{input:function(t){return e.$emit("input",t.target.value)}}})}),[],!1,null,null,null).exports},7804:(e,t,s)=>{"use strict";s.d(t,{Z:()=>r});const n={props:["message"]};const r=(0,s(1900).Z)(n,(function(){var e=this,t=e.$createElement,s=e._self._c||t;return s("div",{directives:[{name:"show",rawName:"v-show",value:e.message,expression:"message"}]},[s("p",{staticClass:"text-sm text-red-600"},[e._v("\n        "+e._s(e.message)+"\n    ")])])}),[],!1,null,null,null).exports},5667:(e,t,s)=>{"use strict";s.d(t,{Z:()=>r});const n={props:["value"]};const r=(0,s(1900).Z)(n,(function(){var e=this,t=e.$createElement,s=e._self._c||t;return s("label",{staticClass:"block font-medium text-sm text-gray-700"},[e.value?s("span",[e._v(e._s(e.value))]):s("span",[e._t("default")],2)])}),[],!1,null,null,null).exports},4760:(e,t,s)=>{"use strict";s.d(t,{Z:()=>r});const n={props:{type:{type:String,default:"button"}}};const r=(0,s(1900).Z)(n,(function(){var e=this,t=e.$createElement;return(e._self._c||t)("button",{staticClass:"inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:text-gray-800 active:bg-gray-50 transition ease-in-out duration-150",attrs:{type:e.type}},[e._t("default")],2)}),[],!1,null,null,null).exports},4459:(e,t,s)=>{"use strict";s.d(t,{Z:()=>n});const n=(0,s(1900).Z)({},(function(){var e=this,t=e.$createElement,s=e._self._c||t;return s("div",{staticClass:"md:col-span-1"},[s("div",{staticClass:"px-4 sm:px-0"},[s("h3",{staticClass:"text-lg font-medium text-gray-900"},[e._t("title")],2),e._v(" "),s("p",{staticClass:"mt-1 text-sm text-gray-600"},[e._t("description")],2)])])}),[],!1,null,null,null).exports},1521:(e,t,s)=>{"use strict";s.r(t),s.d(t,{default:()=>p});var n=s(4359),r=s(3292),o=s(5659),a=s(7804),i=s(5667),l=s(1027),c=s(4760);const u={components:{JetActionMessage:l.Z,JetButton:n.Z,JetFormSection:r.Z,JetInput:o.Z,JetInputError:a.Z,JetLabel:i.Z,JetSecondaryButton:c.Z},props:["user"],data:function(){return{form:this.$inertia.form({_method:"PUT",name:this.user.name,description:this.user.description,username:this.user.username,email:this.user.email,photo:null,banner:null},{bag:"updateProfileInformation",resetOnSuccess:!1}),photoPreview:null,bannerPreview:null}},methods:{updateProfileInformation:function(){this.$refs.photo&&(this.form.photo=this.$refs.photo.files[0]||null),this.$refs.banner&&(this.form.banner=this.$refs.banner.files[0]||null),this.form.post(route("user-profile-information.update"),{preserveScroll:!0})},selectNewPhoto:function(){this.$refs.photo.click()},selectNewBanner:function(){this.$refs.banner.click()},updatePhotoPreview:function(){var e=this,t=new FileReader;t.onload=function(t){e.photoPreview=t.target.result},t.readAsDataURL(this.$refs.photo.files[0])},updateBannerPreview:function(){var e=this,t=new FileReader;t.onload=function(t){e.bannerPreview=t.target.result},t.readAsDataURL(this.$refs.banner.files[0])},deletePhoto:function(){var e=this;this.$inertia.delete(route("current-user-photo.destroy"),{preserveScroll:!0}).then((function(){e.photoPreview=null,e.$refs.photo.value=""}))},deleteBanner:function(){var e=this;this.$inertia.delete(route("current-user-banner.destroy"),{preserveScroll:!0}).then((function(){e.bannerPreview=null,e.$refs.banner.value=""}))}}};const p=(0,s(1900).Z)(u,(function(){var e=this,t=e.$createElement,s=e._self._c||t;return s("jet-form-section",{on:{submitted:e.updateProfileInformation},scopedSlots:e._u([{key:"title",fn:function(){return[e._v("\n        Profile Information\n    ")]},proxy:!0},{key:"description",fn:function(){return[e._v("\n        Update your account's profile information and email address.\n    ")]},proxy:!0},{key:"form",fn:function(){return[e.$page.props.jetstream.managesProfilePhotos?s("div",{staticClass:"col-span-6 sm:col-span-4"},[s("input",{ref:"photo",staticClass:"hidden",attrs:{type:"file"},on:{change:e.updatePhotoPreview}}),e._v(" "),s("jet-label",{attrs:{for:"photo",value:"Photo"}}),e._v(" "),s("div",{directives:[{name:"show",rawName:"v-show",value:!e.photoPreview,expression:"! photoPreview"}],staticClass:"mt-2"},[s("img",{staticClass:"object-cover w-20 h-20 rounded-full",attrs:{src:e.user.profile_photo_url,alt:"Current Profile Photo"}})]),e._v(" "),s("div",{directives:[{name:"show",rawName:"v-show",value:e.photoPreview,expression:"photoPreview"}],staticClass:"mt-2"},[s("span",{staticClass:"block w-20 h-20 rounded-full",style:"background-size: cover; background-repeat: no-repeat; background-position: center center; background-image: url('"+e.photoPreview+"');"})]),e._v(" "),s("jet-secondary-button",{staticClass:"mt-2 mr-2",attrs:{type:"button"},nativeOn:{click:function(t){return t.preventDefault(),e.selectNewPhoto(t)}}},[e._v("\n                Select A New Photo\n            ")]),e._v(" "),e.user.profile_photo_path?s("jet-secondary-button",{staticClass:"mt-2",attrs:{type:"button"},nativeOn:{click:function(t){return t.preventDefault(),e.deletePhoto(t)}}},[e._v("\n                Remove Photo\n            ")]):e._e(),e._v(" "),s("jet-input-error",{staticClass:"mt-2",attrs:{message:e.form.error("photo")}})],1):e._e(),e._v(" "),s("div",{staticClass:"col-span-6 sm:col-span-4"},[s("input",{ref:"banner",staticClass:"hidden",attrs:{type:"file"},on:{change:e.updateBannerPreview}}),e._v(" "),s("jet-label",{attrs:{for:"banner",value:"Banner"}}),e._v(" "),s("div",{directives:[{name:"show",rawName:"v-show",value:!e.bannerPreview,expression:"! bannerPreview"}],staticClass:"mt-2"},[s("img",{staticClass:"object-cover w-full h-36 rounded-md",attrs:{src:e.user.profile_banner_url,alt:"Current Profile Banner"}})]),e._v(" "),s("div",{directives:[{name:"show",rawName:"v-show",value:e.bannerPreview,expression:"bannerPreview"}],staticClass:"mt-2"},[s("span",{staticClass:"block w-full h-36 rounded-md",style:"background-size: cover; background-repeat: no-repeat; background-position: center center; background-image: url('"+e.bannerPreview+"');"})]),e._v(" "),s("jet-secondary-button",{staticClass:"mt-2 mr-2",attrs:{type:"button"},nativeOn:{click:function(t){return t.preventDefault(),e.selectNewBanner(t)}}},[e._v("\n                Select A New Banner\n            ")]),e._v(" "),e.user.profile_banner_path?s("jet-secondary-button",{staticClass:"mt-2",attrs:{type:"button"},nativeOn:{click:function(t){return t.preventDefault(),e.deleteBanner(t)}}},[e._v("\n                Remove Banner\n            ")]):e._e(),e._v(" "),s("jet-input-error",{staticClass:"mt-2",attrs:{message:e.form.error("banner")}})],1),e._v(" "),s("div",{staticClass:"col-span-6 sm:col-span-4"},[s("jet-label",{attrs:{for:"name",value:"Name"}}),e._v(" "),s("jet-input",{staticClass:"block mt-1 w-full",attrs:{id:"name",type:"text",autocomplete:"name"},model:{value:e.form.name,callback:function(t){e.$set(e.form,"name",t)},expression:"form.name"}}),e._v(" "),s("jet-input-error",{staticClass:"mt-2",attrs:{message:e.form.error("name")}})],1),e._v(" "),s("div",{staticClass:"col-span-6 sm:col-span-4"},[s("jet-label",{attrs:{for:"description",value:"Description"}}),e._v(" "),s("textarea",{directives:[{name:"model",rawName:"v-model",value:e.form.description,expression:"form.description"}],staticClass:"form-input rounded-md shadow-sm block mt-1 w-full",attrs:{id:"description",type:"text",rows:"4"},domProps:{value:e.form.description},on:{input:function(t){t.target.composing||e.$set(e.form,"description",t.target.value)}}}),e._v(" "),s("jet-input-error",{staticClass:"mt-2",attrs:{message:e.form.error("description")}})],1),e._v(" "),s("div",{staticClass:"col-span-6 sm:col-span-4"},[s("jet-label",{attrs:{for:"username",value:"Username"}}),e._v(" "),s("jet-input",{staticClass:"block mt-1 w-full",attrs:{id:"username",type:"text"},model:{value:e.form.username,callback:function(t){e.$set(e.form,"username",t)},expression:"form.username"}}),e._v(" "),s("jet-input-error",{staticClass:"mt-2",attrs:{message:e.form.error("username")}})],1),e._v(" "),s("div",{staticClass:"col-span-6 sm:col-span-4"},[s("jet-label",{attrs:{for:"email",value:"Email"}}),e._v(" "),s("jet-input",{staticClass:"block mt-1 w-full",attrs:{id:"email",type:"email",autocomplete:"email"},model:{value:e.form.email,callback:function(t){e.$set(e.form,"email",t)},expression:"form.email"}}),e._v(" "),s("jet-input-error",{staticClass:"mt-2",attrs:{message:e.form.error("email")}})],1)]},proxy:!0},{key:"actions",fn:function(){return[s("jet-action-message",{staticClass:"mr-3",attrs:{on:e.form.recentlySuccessful}},[e._v("\n            Saved.\n        ")]),e._v(" "),s("jet-button",{class:{"opacity-25":e.form.processing},attrs:{disabled:e.form.processing}},[e._v("\n            Save\n        ")])]},proxy:!0}])})}),[],!1,null,null,null).exports},1900:(e,t,s)=>{"use strict";function n(e,t,s,n,r,o,a,i){var l,c="function"==typeof e?e.options:e;if(t&&(c.render=t,c.staticRenderFns=s,c._compiled=!0),n&&(c.functional=!0),o&&(c._scopeId="data-v-"+o),a?(l=function(e){(e=e||this.$vnode&&this.$vnode.ssrContext||this.parent&&this.parent.$vnode&&this.parent.$vnode.ssrContext)||"undefined"==typeof __VUE_SSR_CONTEXT__||(e=__VUE_SSR_CONTEXT__),r&&r.call(this,e),e&&e._registeredComponents&&e._registeredComponents.add(a)},c._ssrRegister=l):r&&(l=i?function(){r.call(this,(c.functional?this.parent:this).$root.$options.shadowRoot)}:r),l)if(c.functional){c._injectStyles=l;var u=c.render;c.render=function(e,t){return l.call(t),u(e,t)}}else{var p=c.beforeCreate;c.beforeCreate=p?[].concat(p,l):[l]}return{exports:e,options:c}}s.d(t,{Z:()=>n})}}]);