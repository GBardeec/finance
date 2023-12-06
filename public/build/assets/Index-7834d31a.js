import{_ as I,I as M,a as w,r as x,c as n,b as v,d as e,w as m,F as u,e as h,t as a,f as _,g as p,h as b,v as y,i as f,o as c}from"./app-bc0ea344.js";const V={components:{IndexFooter:M,IndexHeader:w},name:"IndexFinance",data(){return{value:0,incomes:null,expenses:null,selectedCategory:null,categoryIncomes:null,categoryExpenses:null,errors:[],successMessage:null,deleteMessage:null}},mounted(){this.getIncomes(),this.getExpenses()},methods:{getIncomes(){axios.get("/api/income/all").then(o=>{this.incomes=o.data}).catch(o=>{console.error(o)})},getExpenses(){axios.get("/api/expenses/all").then(o=>{this.expenses=o.data}).catch(o=>{console.error(o)})},getCategoryIncomes(){axios.get("/api/category-incomes").then(o=>{this.categoryIncomes=o.data}).catch(o=>{console.error(o)})},getCategoryExpenses(){axios.get("/api/category-expenses").then(o=>{this.categoryExpenses=o.data}).catch(o=>{console.error(o)})},postIncomes(){this.errors=[],axios.post("/api/income",{value:Number(this.value),selectedCategory:this.selectedCategory}).then(o=>{this.value=0,this.selectedCategory=null,this.incomes=[],this.getIncomes(),this.successMessage="Данные успешно добавлены",setTimeout(()=>{this.successMessage=null},3e3)}).catch(o=>{const t=o.response.data.errors;Object.keys(t).forEach(d=>{t[d].forEach(g=>{this.errors.push(g)})})})},postExpenses(){this.errors=[],axios.post("/api/expenses",{value:Number(this.value),selectedCategory:this.selectedCategory}).then(o=>{this.value=0,this.selectedCategory=null,this.expenses=[],this.getExpenses(),this.successMessage="Данные успешно добавлены",setTimeout(()=>{this.successMessage=null},3e3)}).catch(o=>{const t=o.response.data.errors;Object.keys(t).forEach(d=>{t[d].forEach(g=>{this.errors.push(g)})})})},deleteOneIncome(o){axios.delete(`/api/income/delete/${o}`).then(t=>{this.deleteMessage="Данные успешно удалены",setTimeout(()=>{this.deleteMessage=null},2e3),this.incomes=null,this.getIncomes()}).catch(t=>{console.error(t)})},deleteOneExpense(o){axios.delete(`/api/expenses/delete/${o}`).then(t=>{this.deleteMessage="Данные успешно удалены",setTimeout(()=>{this.deleteMessage=null},2e3),this.expenses=null,this.getExpenses()}).catch(t=>{console.error(t)})},getExportExcel(){axios.get("/api/export",{responseType:"arraybuffer"}).then(o=>{const t=new Blob([o.data],{type:"application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"}),d=document.createElement("a");d.href=window.URL.createObjectURL(t),d.download="finance.xlsx",d.click()}).catch(o=>{console.error(o)})}}},L={class:"container"},O=e("h2",{class:"text-center"}," Ваши финансы: ",-1),T={class:"mt-5"},F={class:"row"},N={class:"col-6 main-finance"},U=e("h5",{class:"text-center"}," Ваши доходы ",-1),B={class:"mt-4"},D={class:"table"},j=e("thead",null,[e("tr",null,[e("th",{scope:"col"},"#"),e("th",{scope:"col"},"Категория"),e("th",{scope:"col"},"Значение"),e("th",{scope:"col"},"Кнопка")])],-1),H={key:0},R={scope:"row"},S=["onClick"],q={colspan:"4"},z={key:1},A=e("tr",null,[e("td",{class:"not-text",colspan:"4"},"Список пуст")],-1),G=[A],J={class:"col-6 main-finance"},K=e("h5",{class:"text-center"}," Ваши расходы ",-1),P={class:"mt-4"},Q={class:"table"},W=e("thead",null,[e("tr",null,[e("th",{scope:"col"},"#"),e("th",{scope:"col"},"Категория"),e("th",{scope:"col"},"Значение"),e("th",{scope:"col"},"Кнопка")])],-1),X={key:0},Y={scope:"row"},Z=["onClick"],$={colspan:"4"},ee={key:1},se=e("tr",null,[e("td",{class:"not-text",colspan:"4"},"Список пуст")],-1),te=[se],oe={key:0,class:"text-center mt-4"},le={class:"modal fade",id:"income",tabindex:"-1","aria-labelledby":"exampleModalLabel","aria-hidden":"true"},ne={class:"modal-dialog"},ce={class:"modal-content"},ae=e("div",{class:"modal-header"},[e("h5",{class:"modal-title",id:"exampleModalLabel"},"Добавление доходов"),e("button",{type:"button",class:"btn-close","data-bs-dismiss":"modal","aria-label":"Закрыть"})],-1),re={class:"modal-body"},ie={key:0,class:"alert alert-danger"},de={class:"m-0"},ue={class:"mt-4"},he=["value"],_e={class:"modal-footer"},pe=e("button",{type:"button",class:"btn btn-secondary","data-bs-dismiss":"modal"},"Закрыть",-1),me={key:0,class:"alert-container"},ge={class:"alert alert-secondary",role:"alert"},be={class:"modal fade",id:"expenses",tabindex:"-1","aria-labelledby":"exampleModalLabel","aria-hidden":"true"},xe={class:"modal-dialog"},ve={class:"modal-content"},ye=e("div",{class:"modal-header"},[e("h5",{class:"modal-title",id:"exampleModalLabel"},"Добавление расходов"),e("button",{type:"button",class:"btn-close","data-bs-dismiss":"modal","aria-label":"Закрыть"})],-1),fe={class:"modal-body"},ke={key:0,class:"alert alert-danger"},Ce={class:"m-0"},Ee={class:"mt-4"},Ie=["value"],Me={class:"modal-footer"},we=e("button",{type:"button",class:"btn btn-secondary","data-bs-dismiss":"modal"},"Закрыть",-1),Ve={key:0,class:"alert-container"},Le={class:"alert alert-secondary",role:"alert"},Oe={key:0,class:"alert-container"},Te={class:"alert alert-danger",role:"alert"};function Fe(o,t,d,g,l,i){const k=x("IndexHeader"),C=x("IndexFooter");return c(),n(u,null,[v(k),e("div",L,[e("main",null,[e("div",null,[O,e("div",T,[e("div",F,[e("div",N,[U,e("div",B,[e("button",{type:"button",class:"btn btn-secondary mb-3","data-bs-toggle":"modal","data-bs-target":"#income",onClick:t[0]||(t[0]=m((...s)=>i.getCategoryIncomes&&i.getCategoryIncomes(...s),["prevent"]))}," Добавить доходы ")]),e("table",D,[j,l.incomes&&l.incomes.length>0?(c(),n("tbody",H,[(c(!0),n(u,null,h(l.incomes,(s,r)=>(c(),n("tr",{key:r},[e("th",R,a(r+1),1),e("td",null,a(s.category.title),1),e("td",null,a(s.value)+" руб.",1),e("td",null,[e("button",{class:"btn btn-danger",onClick:E=>i.deleteOneIncome(s.id)}," Удалить ",8,S)])]))),128)),e("tr",null,[e("td",q,"Итог: "+a(this.incomes.reduce((s,r)=>s+r.value,0))+" руб. ",1)])])):(c(),n("tbody",z,G))])]),e("div",J,[K,e("div",P,[e("button",{type:"button",class:"btn btn-secondary mb-3 float-end me-3","data-bs-toggle":"modal","data-bs-target":"#expenses",onClick:t[1]||(t[1]=m((...s)=>i.getCategoryExpenses&&i.getCategoryExpenses(...s),["prevent"]))}," Добавить расходы ")]),e("table",Q,[W,l.expenses&&l.expenses.length>0?(c(),n("tbody",X,[(c(!0),n(u,null,h(l.expenses,(s,r)=>(c(),n("tr",{key:r},[e("th",Y,a(r+1),1),e("td",null,a(s.category.title),1),e("td",null,a(s.value)+" руб.",1),e("td",null,[e("button",{class:"btn btn-danger",onClick:E=>i.deleteOneExpense(s.id)}," Удалить ",8,Z)])]))),128)),e("tr",null,[e("td",$,"Итог: "+a(this.expenses.reduce((s,r)=>s+r.value,0))+" руб. ",1)])])):(c(),n("tbody",ee,te))])]),l.expenses&&l.expenses.length>0&&l.incomes&&l.incomes.length>0?(c(),n("div",oe,[e("p",null,[_(" Итоговое значение составляет: "),e("b",null,a(this.incomes.reduce((s,r)=>s+r.value,0)-this.expenses.reduce((s,r)=>s+r.value,0)),1),_(" руб. ")]),e("button",{class:"btn btn-secondary",onClick:t[2]||(t[2]=m(s=>i.getExportExcel(),["prevent"]))}," Экспортировать данные в Excel ")])):p("",!0)])])])])]),v(C),e("div",le,[e("div",ne,[e("div",ce,[ae,e("div",re,[l.errors.length>0?(c(),n("div",ie,[e("ul",de,[(c(!0),n(u,null,h(l.errors,s=>(c(),n("li",{key:s},a(s),1))),128))])])):p("",!0),e("div",null,[_(" Введите сумму: "),b(e("input",{class:"input-group-text w-100","onUpdate:modelValue":t[3]||(t[3]=s=>l.value=s)},null,512),[[y,l.value]])]),e("div",ue,[_(" Выберите подходящую категорию: "),b(e("select",{class:"form-select","aria-label":"Default select example","onUpdate:modelValue":t[4]||(t[4]=s=>l.selectedCategory=s)},[(c(!0),n(u,null,h(l.categoryIncomes,s=>(c(),n("option",{value:s.id},a(s.title),9,he))),256))],512),[[f,l.selectedCategory]])])]),e("div",_e,[pe,e("button",{type:"button",class:"btn btn-primary",onClick:t[5]||(t[5]=m((...s)=>i.postIncomes&&i.postIncomes(...s),["prevent"]))},"Сохранить")])])]),l.successMessage?(c(),n("div",me,[e("div",ge,a(l.successMessage),1)])):p("",!0)]),e("div",be,[e("div",xe,[e("div",ve,[ye,e("div",fe,[l.errors.length>0?(c(),n("div",ke,[e("ul",Ce,[(c(!0),n(u,null,h(l.errors,s=>(c(),n("li",{key:s},a(s),1))),128))])])):p("",!0),e("div",null,[_(" Введите сумму: "),b(e("input",{class:"input-group-text w-100","onUpdate:modelValue":t[6]||(t[6]=s=>l.value=s)},null,512),[[y,l.value]])]),e("div",Ee,[_(" Выберите подходящую категорию: "),b(e("select",{class:"form-select","aria-label":"Default select example","onUpdate:modelValue":t[7]||(t[7]=s=>l.selectedCategory=s)},[(c(!0),n(u,null,h(l.categoryExpenses,s=>(c(),n("option",{value:s.id},a(s.title),9,Ie))),256))],512),[[f,l.selectedCategory]])])]),e("div",Me,[we,e("button",{type:"button",class:"btn btn-primary",onClick:t[8]||(t[8]=m((...s)=>i.postExpenses&&i.postExpenses(...s),["prevent"]))},"Сохранить")])])]),l.successMessage?(c(),n("div",Ve,[e("div",Le,a(l.successMessage),1)])):p("",!0)]),l.deleteMessage?(c(),n("div",Oe,[e("div",Te,a(l.deleteMessage),1)])):p("",!0)],64)}const Ue=I(V,[["render",Fe]]);export{Ue as default};
