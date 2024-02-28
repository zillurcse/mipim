// export default{
//   data(){
//     return{
//       blur: document.querySelector("#blur"),
//       backdrop: document.querySelector("#backdropid"),
//       hiddensidebar: document.querySelector("#hiddensidebar"),
//       dropdown: document.querySelectorAll("#sidedropdown"),
//       navimg: document.querySelector("#navimg"),
//       mainsidebar: document.querySelector("#mainsidebar"),
//       displaynone: document.querySelectorAll(".displaynone"),
//       hiddensidebar2:document.querySelector("#hiddensidebar2")
//     }
//   },
//
// created(){
//     this.navimg.addEventListener("click", () => {
//     const isopen = this.navimg.getAttribute("data-open");
//     console.log(isopen);
//
//     if (isopen == "false") {
//       this.navimg.setAttribute("data-open", "true");
//       this.mainsidebar.style.width = "5.5rem";
//       Array.from(displaynone).forEach((elmt) => {
//         elmt.style.display = "none";
//       });
//     } else {
//       this.navimg.setAttribute("data-open", "false");
//       this.mainsidebar.style.width = "23rem";
//       Array.from(displaynone).forEach((elmt) => {
//         elmt.style.display = "block";
//       });
//     }
//   });
//
//   Array.from(this.dropdown).forEach((dom) => {
//     dom.addEventListener("click", () => {
//       const drop = dom.getElementsByClassName("dropdownitem");
//       const isOpen = dom.getAttribute("open");
//       const image = dom.getElementsByTagName("img")[1];
//
//       if (isOpen == "true") {
//         dom.setAttribute("open", "false");
//         drop[0].style.maxHeight = "0px";
//         image.style.transform = "rotate(0deg)";
//       } else {
//         dom.setAttribute("open", "true");
//         drop[0].style.maxHeight = "700px";
//         image.style.transform = "rotate(90deg)";
//       }
//     });
//   });
//
//   this.openHiddenbar()
// this.closeHiddenbar()
// this.openHiddenbar2()
// this.closeHiddenbar2()
// },
//
// methods:{
//
//   openHiddenbar() {
//     this.blur.classList.add("backgroundblur");
//     this.hiddensidebar.style.right = "0px";
//     this.backdrop.style.display = "block";
//   },
//
//   closeHiddenbar() {
//     this.blur.classList.remove("backgroundblur");
//     this.backdrop.style.display = "none";
//     this.hiddensidebar.style.right = "-50rem";
//   },
//
//
//   openHiddenbar2() {
//     this.blur.classList.add("backgroundblur");
//     this.hiddensidebar2.style.right = "0px";
//     this.backdrop.style.display = "block";
//   },
//
//   closeHiddenbar2() {
//     this.blur.classList.remove("backgroundblur");
//
//     this.backdrop.style.display = "none";
//     this.hiddensidebar2.style.right = "-50rem";
//   }
// }
//
// }
