<template>
  <div class="main">
    <div class="popup" v-if="popup">
      <div class="popup-bg" @click="type !== undefined ? popup = false : ''"></div>
      <div class="popup-content">
        <div class="popup-content-message" :class="{'success': type === true,'error': type === false,'await': type === undefined}">{{message}}</div>
        <div class="popup-content-button" @click="type !== undefined ? popup = false : ''">Закрыть</div>
      </div>
    </div>

    <div class="header" ref="section-1">
      <div class="logo">
        <div class="logo-item">
          <div class="logo-item-row">
            <div :class="{center: i === 2}" v-for="i in 3"></div>
          </div>
          <div class="logo-item-row">
            <div :class="{center: i === 2}" v-for="i in 3"></div>
          </div>
        </div>
        <div class="logo-name">
          <div class="logo-name-first">NB</div>
          <div class="logo-name-second">HOLDING</div>
        </div>
      </div>
      <div class="phone">
        <a href="tel:87005040030" class="phone-main">+7 (700) <span>504 00 30</span></a>
        <div class="phone-title">звонок беслатно</div>
      </div>
    </div>
      <img src="/static/first.png" style="display: none">

    <div class="body">
      <div class="body-abouter" ref="section-1">
        <img src="/static/first.png">
        <div class="body-abouter-content">
          
          <div class="body-abouter-content-info">
            <div class="body-abouter-content-info-title">{{info.title}}</div>
            <div class="body-abouter-content-info-about">{{info.about}}</div>
          </div>
          <div class="body-abouter-content-statistics">
            <div class="body-abouter-content-statistics-statistic" v-for="statistic in info.statistics">
              <div class="body-abouter-content-statistics-statistic-value">{{statistic.value}}+</div>
              <div class="body-abouter-content-statistics-statistic-name">{{statistic.name}}</div>
            </div>
          </div>
          <div class="body-abouter-content-info-button">{{info.button}}</div>
        </div>

      </div>

      <div class="body-projects" ref="section-2">
        <div class="body-projects-title">Завершённые проекты</div>
        <div class="body-projects-item">
          <div class="body-projects-item-poject" v-for="project in projects">
            <div class="body-projects-item-poject-ending">Сдан в {{' ' + project.ending + ' '}} году</div>
            <img class="body-projects-item-poject-img" :src="'/static/' + project.img">
            <div class="body-projects-item-poject-name">{{project.name}}</div>
          </div>
        </div>
      </div>


      <div class="body-now" ref="section-3">
        <div class="body-now-title">Сейчас <span>в продаже</span></div>

        <div class="body-now-content">
          <div class="body-now-content-name">{{now.name}}</div>

          <div class="body-now-content-pluses" v-for="plus in now.pluses">
            <div class="body-now-content-pluses-title">{{plus.title}}</div>
            <div class="body-now-content-pluses-about">{{plus.about}}</div>
          </div>
          <div class="body-abouter-content-info-button button">Скачать планировки и узнать стоимость </div>
          
        </div>
        <div class="body-now-gallery">
          <div :class="'img_' + checkGal(i)" :style="{background: `linear-gradient(0deg, rgba(0, 0, 0, ${checkGradient(i) * 0.33}), rgba(0, 0, 0, ${checkGradient(i) * 0.33})), url(/static/${img})`}" v-for="(img, i) in now.gallery"></div>
        </div>
      </div>

      <form class="body-form" method="POST" @submint.prevent="sendEmail" ref="section-6">
        <div class="body-form-title">Скачайте подробную презентацию жилого комплекса "Grand Avenue"</div>

        <div class="body-form-body">
          <label class="body-form-body-input" v-for="(input, i) in inputs" :for="'input-'+i">
            <div class="body-form-body-input-name" :class="{'active': input.focus || input.data}">{{input.name}}</div>
            <input :name="input.sub" :id="'input-'+i" @focus="input.focus = true" @blur="input.focus = false" v-model="input.data" required autocomplete="off">
            <textarea :name="input.sub" :id="'input-'+i" @focus="input.focus = true" @blur="input.focus = false" v-model="input.data" v-if="false" required autocomplete="off"></textarea>
          </label>
        </div>
        <label class="body-form-button" for="form-1">Получить</label>
        <input type="submit" id="form-1" @click="sendEmail" style="display: none">
      </form>


      <div class="body-offices" ref="section-4">
        <div class="body-offices-title">Офисы продаж</div>
        <div class="body-offices-map">
          <iframe src="https://yandex.ru/map-widget/v1/?um=constructor%3A7a35d7cb0b42abd3ebcd520737a630827d8a1c61654e1e11988cc245b56b8782&amp;source=constructor" width="500" height="400" frameborder="0"></iframe>
        </div>

        <div class="body-offices-content">
          <div class="body-offices-content-office" v-for="office in offices">
            <div class="body-offices-content-office-location">{{office.location}}</div>
            <div class="body-offices-content-office-working">{{office.working}}</div>
          </div>
        </div>
      </div>


      <div class="body-developer" ref="section-5">
        <div class="body-developer-title">О застройщике</div>
        <div class="body-developer-about">Осуществляем полный цикл работ от строительства до продажи квартир</div>

        <div class="body-developer-body">
          <div class="body-developer-body-column" :style="{left: '-' + (page * 100) + 'vw'}">
            <div class="body-developer-body-column-text" v-for="about in abouts"><span>{{about.div}}</span>{{about.first}}{{about.all}}</div>
          </div>
          <img class="body-developer-body-img" src="/static/arrow_group.png" :style="{left: (-(page * 50) + 50) + '%'}">
        </div>

        <div class="body-developer-pages">
          <div class="body-developer-pages-page" :class="{'active': page === i-1}" @click="page = i-1" v-for="i in pages"></div>
        </div>

      </div>

    </div>

    <div class="footer" ref="section-5">
      <div class="footer-links __new">
        <a href=""><img src="/static/facebook.svg"></a>
        <a href=""><img src="/static/instagram.svg"></a>
        <a href=""><img src="/static/whatsapp.svg"></a>
      </div>
      <!--<div class="footer-col"> 
        <div class="footer-title">Мы всегда рады сотрудничеству!</div>
        <div class="footer-links"><a href=""></a><a href=""></a><a href=""></a></div>
      </div> 
      <div class="footer-col">
        <a href="tel:87005040030" class="footer-phone">8 700 504 00 30</a>
        <a href="geo:43.2593064,76.9297241,15" class="footer-address">г. Алматы, Достык 97 Б, 278 офис </a>
        <div class="footer-copy">help@nb-holding.kz</div>
      </div> -->
    </div>
  </div>
</template>

<script>
  import Vue from "vue";
  export default Vue.extend({
    data: () => {
      return {
        touch: 0,
        scrolling: true,
        page: 0,
        pages: 3,
        main_page: 0,
        gal_item: 0,
        popup: false,
        type: undefined,
        message: '',
        now: {
          name: 'ЖК “Grand Avenue”',
          gallery: ['now_0.png','now_1.jpeg','now_2.jpeg','now_3.jpeg','now_4.jpeg','now_5.jpeg'],
          pluses: [
            {
              title: 'Премиальное качество',
              about: 'Авторская архитектура, модный дизайн и высокие технологии'
            },
            {
              title: 'Идеальная среда для жизни',
              about: 'Все необходимая инфраструктура поблизости'
            },
            {
              title: 'Удобное расположение',
              about: 'В самом центре Актау, в 28 микрорайоне'
            }
          ]
        },
        offices: [
          {
            location: '28 микрорайон, жилой комплекс «Grand Avenue»',
            working: 'Понедельник- Суббота с 11:00 до 20:00'
          },
          // {
          //   location: 'пр Абая, уг.пр Гагарина',
          //   working: 'Понедельник - Воскресенье с 09:00 до 20:00'
          // },
          // {
          //   location: 'пр Абая, уг.пр Гагарина',
          //   working: 'Понедельник - Воскресенье с 09:00 до 20:00'
          // }
        ],
        inputs: [
          {
            name: 'Имя',
            sub: 'name',
            data: '',
            focus: false
          },
          {
            name: 'Телефон',
            sub: 'phone',
            data: '',
            focus: false
          },
          // {
          //   name: 'Напишите свой вопрос',
          //   sub: 'message',
          //   data: '',
          //   focus: false
          // } 
        ],
        abouts: [
          {
            div: 'Строительная компания',  
            first: ' «NB Constructions» входит в состав группы компаний «NB Holding».'
          },
          {  
            div: 'Начиная',  
            first: ' с 2014 года мы построили и  сдали в срок 2 жилых комплекса в Актау и еще 2 находятся на стадии возведения на данный момент',
          },
          { 
            div: 'В процессе',  
            first: ' проектирования еще 3 жилых комплекса в г. Актобе и г. Алматы. ',
          }
        ],
        projects: [
          {
            name: 'ЖК “Инара”',
            ending: 2017,
            img: 'city_1.png'
          },
          {
            name: 'ЖК “Family Town”',
            ending: 2018,
            img: 'city_0.png'
          }
        ],
        info: {
          title: 'ВЫБЕРИ СВОЮ КВАРТИРУ',
          about: 'выгодные цены напрямую от застройщика',
          button: 'Скачать планировки и узнать стоимость ',
          statistics: [
            {
              value: 0,
              max_value: 6,
              name: 'лет мы строим для вас жилые дома'
            },
            {
              value: 0,
              max_value: 400,
              name: 'семей проживают в наших ЖК'
            },
            {
              value: 0,
              max_value: 400,
              name: 'семей проживают в наших ЖК'
            }
          ]
        }
      }
    },
    async mounted(){
      for(let i_static of this.info.statistics){
        let inter = setInterval(()=>{
          if(i_static.value <= i_static.max_value - 1)
            i_static.value++
          else 
            clearInterval(inter)
        },(800 / i_static.max_value))
      }
      // document.scrollingElement.addEventListener("wheel", e => this.onWheel(e));

      document.body.ontouchstart = e => {
        this.touch = e.touches[0].clientX
      }
      document.body.ontouchend = e => {
        let x = e.changedTouches[0].clientX, index

        if(this.touch - x > (document.body.clientWidth/3))
          index = 1
        else if(x -this.touch > (document.body.clientWidth/3))
          index = -1

        if(index)
          this.switchPage(index)
        this.touch = 0;
      }
    }, 
    created(){
      setInterval(()=>this.switchPage(1),10000)
      setInterval(()=>{
        if(this.gal_item + 1 >= this.now.gallery.length)
          this.gal_item = 0
        else this.gal_item++
      },2000)
      document.scrollingElement.onscroll = () => { this.scrolling = false}
    },
    methods:{
      checkGradient(index){
        let end = 0
        if(this.gal_item === index)
          end = 0
        else if(this.gal_item + 1 === index ||  this.gal_item + 1 - this.now.gallery.length-1 === index)
          end = 1
        else if(this.gal_item + 2 === index ||  this.gal_item + 2 - this.now.gallery.length-1 === index)
          end = 2
        return end
      },
      checkGal(index){
        let end, type
        type = this.gal_item - 1
        if( type <= 0 ) type += this.now.gallery.length-1
        if(index === type)
          type = 0
        else{
          for(let i = 1; i < 4; i++){
            type = this.gal_item + i
            if( type > this.now.gallery.length-1 ) type -= this.now.gallery.length-1
            if(index === type){
              type = i
              break;
            }else
              type = 4
          }
          if(this.gal_item === index) type = 5
        }
        switch( type ){
          case 1: end = '1'; break; 
          case 2: end = '2'; break; 
          case 5: end = '0'; break; 
          default: end = 'behind'; break;
        }
        return end
      },
      onWheel(e){
        if(this.scrolling){
          this.scrolling = false
          if(e.deltaY < 0)
            this.main_page--
          else
            this.main_page++

          if(this.main_page <= 0)
            this.main_page = 0
          else if(this.main_page >= 6)
            this.main_page = 6

          let doc = document.scrollingElement
          let top, end, status = false

          top = document.scrollingElement.scrollTop
          end = this.$refs['section-' + this.main_page].offsetTop + (this.main_page ? doc.clientHeight + (doc.clientHeight / 10) : 0)

          if( top > end){
            status = true
          }

          let inter = setInterval(()=>{

            let start = !status  ? doc.scrollTop 
                                 : end
            let finish = status ? doc.scrollTop 
                                : end

            if(start >= finish || (this.main_page === 5 && doc.scrollTop === ( doc.scrollHeight - doc.clientHeight))){
              clearInterval(inter)
              this.scrolling = true
            }
            doc.scrollTo({
              top: doc.scrollTop + (status ? -5: 5),
            })
          },0)
          // scrollingElement.scrollTo({
          //   top: this.$refs['section-' + this.main_page].offsetTop,
          // })
        }
         
      },
      popupMessage(e){
        this.type = e
        if(e === false)
          this.message = 'Ой! Что-то пошло не так, попробуйте повторить запрос позже.'
        else if(e === true)
          this.message = 'Ваш запрос обрабатывается, в ближайшее время с вами свяжется консультант.'
        else
          this.message = 'Пожалуйста, подождите, пока ваш запрос отправится.'
        this.popup = true
      },
      sendEmail(e){
        e.preventDefault();
        this.popupMessage(undefined)
        let data = {_replyto: 'help@nb-holding.kz'}
        for(let i = 0; i < this.inputs.length; i++)
          data[this.inputs[i].sub] = this.inputs[i].data
        data = this.changeData(data)
        this.$axios
         .post(
          // 28761310.122737@parser.amocrm.ru
              "mail.php",
              data
         )
         .then(res => {
            for(let i = 0; i < this.inputs.length; i++)
              this.inputs[i].data = ''
            this.popupMessage(true)
         })
         .catch(err => {
            this.popupMessage(false)
         })
       return false
      },
      changeData(data){
        let formData = new FormData()
        Object.keys(data).forEach(key => {
          formData.append(key, data[key])
        })
        return formData
      },
      switchPage(index){
        if(this.page+index >= this.pages)
          this.page = 0
        else if(this.page+index < 0)
          this.page = this.pages-1
        else
          this.page += index
      }
    }
  });
</script>

<style lang="scss" >
  
  $white: #FFFFFF;
  $white_d: #FFF2DB;
  $black: #1A1919;
  $black_052: rgba(0, 0, 0, 0.52);
  $font: #333333;
  $font_input: #828282;
  $yellow: #C8A564;
  $yellow_shadow: #EBDBBF;
  $yellow_bg: #FCF6EC;
  $yellow_l: #69552E;
  $yellow_d: #937643;
  $yellow_092: rgba(200, 165, 100, 1);
  $yellow_080: rgba(187, 162, 118, 0.8);

  @font-face {
    font-family: "Gilroy";
    src: url('/static/fonts/Gilroy-Regular.ttf') format("truetype");
  }
  @mixin gilroy {
    font-family: "Gilroy" ;
  }
  body{
    margin: 0 auto;
    max-width: 1440px;
    display: flex;
    justify-content: center;
    align-items: center;
    overflow-x: hidden;
    text-align: center;
  }
  div, form, label, a{
    display: flex;
    width: 100%;
    max-width: 100vw;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    box-sizing: border-box;
    position: relative;
    text-align: center; 
    text-decoration: none;
    color: $font;
    transition: 0.3s;
    cursor: default;
    @include gilroy();
  }
  img{
    user-select: none;
  }
  *::-webkit-scrollbar-thumb{
    background-color: $yellow;
    border-radius: 5px;
    cursor: pointer;
  }
  *::-webkit-scrollbar {
    // background-color: $font_l;
    width: 5px;
  }

  .popup{
    position: fixed;
    top: 0;
    left: 0;
    height: 100vh;
    width: 100vw;
    justify-content: center;
    align-items: center;
    z-index: 20;
    &-bg{
      position: absolute;
      height: 100%;
      width: 100%;
      background-color: #00000080;
    }
    &-content{
      border-radius: 10px;
      background-color: $white;
      width: 80%;
      padding: 2.5%;
      max-width: 400px;
      &-message{
        color: $black;
        font-weight: bold;
        font-size: 16px;
        line-height: 20px;
        margin-bottom: 5%;
        &.success{
          color: #00ca1c;
        }
        &.error{
          color: #ff2b2b;
        }
        &.await{
          color: #888888;
        }
      }
      &-button{
        color: $black;
        border: 1px solid $black;
        border-radius: 50px;
        cursor: pointer;
        width: auto;
        padding: 12px 32px;
      }
    }
  }

  .main{
    
  }
  .header{
    height: auto;
    flex-direction: row;
    justify-content: space-between;
    z-index: 0;
    padding: 1rem 3rem 0;
  }
  .logo{
    height: auto !important;
    // position: absolute;
    // top: 35vh;
    z-index: 2;
    flex-direction: row;
    width: auto;
    &-item{
      width: auto;
      &-row{
        width: auto;
        flex-direction: row;
        animation: open_logo 1s linear 1 forwards;
        &:last-child{
          animation: open_logo_rev 1s linear 1 forwards;
          // animation-direction: reverse;
        }
        &>div{
          background-color: $yellow;
          transform: skewY(-40deg);
          height: 24px;
          width: 36px;
          margin: 2px 1.5px;
          &.center{
            transform: skewY(40deg);
          }
        }
      }
    }
    &-name{
      font-size: 36px;
      align-items: flex-start;
      margin-left: 16px;
      user-select: none;
      cursor: default;
      &-first{
        font-weight: bold;
        color: $black;
        // margin-bottom: 8px;
        width: auto;
      }
      &-second{
        width: auto;
        color: $black;
      }
    }
  }
  .phone{
    width: auto;
    flex-direction: column;
    animation: open_head 1.5s linear 1 forwards;
   &-main{
    cursor: pointer;
    display: block;
    white-space: nowrap;
    font-weight: 600;
    font-size: 32px;
    line-height: 37px;
    &>span{
      font-size: 48px;
      color: $yellow;
    }
   }
   &-title{
    font-weight: 300;
    font-size: 18px;
    line-height: 21px;
   } 
  }
  .body{

    &>div{
      // min-height: 100vh;
      // max-height: 100vh;
    }
    &-abouter{
      // min-height: calc(100vh - 100px);
      flex-direction: row;
      justify-content: center;
      align-items: flex-end;
      &:after{
        content: "";
        position: absolute;
        bottom: -25px;
        height: 60px;
        width: 100%;
        background-color: $yellow;
      }
      &>img{
        top: 0;
        width: 40%;
        animation: open_img 1s ease-in-out 1 forwards;
      }
      &-content{
        min-height: 100vh;
        padding: 0 5% 60px;
        flex-direction: column;
        justify-content: center;
        width: 60%;
        &-statistics{
          width: calc(100% + 30px);
          flex-direction: row;
          &-statistic{
            margin: 0 15px 45px;
            &-value{
              color: $yellow;
              font-weight: 800;
              font-size: 80px;
              line-height: 49px;
              margin-bottom: 12px;
            }
            &-name{
              color: $yellow_l;
              font-weight: 500;
              font-size: 18px;
              line-height: 21px;
            }
          }
        }
        &-info{
          align-items: flex-start;
          &-title{
            text-align: left;
            width: auto;
            font-weight: 800;
            font-size: 50px;
            line-height: 150%;
            animation: open_head 1s ease-out 1 forwards;
          }
          &-about{
            text-align: left;
            width: auto;
            font-weight: bold;
            font-size: 24px;
            line-height: 28px;
            margin: 16px 0 52px;
          }
          &-button{
            width: 312px;
            padding: 12px 60px;
            background: #3DAF42;
            border-radius: 25px;
            color: $white;
            font-weight: 500;
            font-size: 18px;
            line-height: 21px;
            cursor: pointer; 
            transition: 0.1s;
            &:hover{
              color: $white;
            }
          }
        }
      }
    }
    &-projects{
      background-color: $yellow_bg;
      padding: 60px 5%;
      &-title{
        font-weight: bold;
        font-size: 60px;
        line-height: 73px;
        margin-bottom: 60px;
        align-items: flex-start;
      }
      &-item{
        flex-direction: row;
        flex-wrap: wrap;
        width: 100%;
        // justify-content: space-between;
        &-poject{
          width: 100%;
          max-width: 400px;
          margin: 15px 8%;
          align-items: flex-start;
          border-radius: 10px;
          overflow: none;
          &-ending{
            color: $white_d;
            font-weight: 600;
            font-size: 21px;
            line-height: 24px;
            background-color: $yellow;
            position: absolute;
            width: 50%;
            padding: 12px 9px;
            top: 16px;
            left: 0;
          }
          &-img{
            width: 100%;
          }
          &-name{
            margin: 5% 0;
            text-align: center;
            color: $yellow_d;
            font-weight: 600;
            font-size: 26px;
            line-height: 30px;
          }
        }
      }
    }
    &-now{
      background-color: $yellow_bg;
      flex-direction: row;
      flex-wrap: wrap;
      justify-content: flex-start;
      padding: 0 5% 60px;
      &-title{
        width: 100%;
        text-align: left;
        font-weight: bold;
        font-size: 60px;
        line-height: 73px;
        display: block;
        white-space: nowrap;
        &>span{
          padding: 0 1rem;
          background-color: $yellow;
          color: $white;
        }
      }
      &-content{
        width: 50%;
        padding-right: 60px;
        align-items: flex-start;
        &-name{
          font-weight: 600;
          font-size: 36px;
          line-height: 41px;
          color: $yellow_d;
          align-items: flex-start;
          margin: 30px 0 10px;
        }
        &-pluses{
          padding-left: 30px;
          &-title{
            align-items: flex-start;
            font-weight: 500;
            font-size: 28px;
            line-height: 33px;
            color: $black;
            margin: 30px 0 20px;
            &:after{
              content: "";
              position: absolute;
              left: -30px;
              background-color: $yellow;
              height: 17px;
              width: 21px;
              border-radius: 3px;
            }
          }
          &-about{
            align-items: flex-start;
            text-align: left;
            font-weight: 300;
            font-size: 24px;
            line-height: 28px;
          }
        }
        &>.button{
          margin-top: 16px;
          margin-left: 30px;
        }
      }
      &-gallery{
        width: 50%;
        padding-right: 10%;
        &>div{
          position: absolute;
          height: 50vh;
          border-radius: 30px;
          overflow: hidden;
          background-size: 125% 125% !important;
          background-position: 25% 25% !important;
          box-shadow: 10px 24px 44px rgba(0, 0, 0, 0.18);
          &.img_behind{
            opacity: 0;
            z-index: 0;
            transform: translate(20%, 0%);
          }
          &.img_0{
            z-index: 3;
            transform: translate(0, 20%);
          }
          &.img_1{
            z-index: 2;
            background-color: linear-gradient(0deg, rgba(0, 0, 0, 0.33), rgba(0, 0, 0, 0.33));
            transform: translate(10%, 10%);
          }
          &.img_2{
            z-index: 1;
            transform: translate(20%, 0%);
          }
        }
      }
    }

    &-offices{
      background-color: $yellow_bg;
      flex-wrap: wrap;
      padding: 60px 5%;
      flex-direction: row;
      &-title{
        align-items: flex-start;
        font-weight: bold;
        font-size: 60px;
        line-height: 73px;
        margin-bottom: 35px;
      }
      &-map{
        width: auto;
        height: 50vh;
        // background-color: $yellow;
        overflow: hidden; 
        box-shadow: 6px 8px 24px rgba(0, 0, 0, 0.15);
        border-radius: 30px;
      }
      &-content{
        width: calc(50% - 30px);
        margin-left: 30px;
        &-office{
          padding-left: 30px;

          &-location{
            align-items: flex-start;
            text-align: left;
            font-weight: 500;
            font-size: 28px;
            line-height: 33px;
          }
          &-working{
            margin: 20px 0 50px;
            align-items: flex-start;
            text-align: left;
            font-weight: 300;
            font-size: 24px;
            line-height: 28px;
          }
        }
      }
    }

    &-developer{
      min-height: 100vh;
      padding: 5%;
      padding-right: unset;
      background-color: $yellow_bg;
      justify-content: flex-start;
      padding-bottom: 12.5vw;
      &-title{
        align-items: flex-start;
        // color: $yellow_l;
        font-weight: bold;
        font-size: 60px;
        line-height: 73px;
        margin-bottom: 20px;
      }
      &-about{
        display: none;
        font-size: 30px;
        line-height: 35px;
        margin: 40px;
      }
      &-body{
        flex-direction: row;
        &-column{
          align-items: flex-start;
          &-text{
            width: 80%;
            display: block;
            text-align: left;
            flex-direction: row;
            flex-wrap: wrap;
            justify-content: flex-start;
            font-size: 22px;
            line-height: 27px;
            margin-bottom: 48px;
            &:nth-child(2)>span:first-child:after{
              width: 110%;
              right: -2.5%;
            }
            &>span{
              position: relative;
              text-align: left;
              width: auto;
              margin: 0 5px;
              z-index: 1;
              &:first-child{
                color: $white;
                &:after{
                  content: "";
                  width: calc(100% + 6vw);
                  right: 0;
                  position: absolute;
                  height: 32px;
                  background: $yellow;
                  z-index: -1;
                }
              }
            }
          }
        }
        &>img{
          max-width: 50%;
        }
      }
    }

    &-form{
      background-color: $yellow_092;
      width: 100%;
      padding: 50px;
      z-index: 1;
      // padding-bottom: 15.5vw;
      &-title{
        color: $yellow_l;
        font-weight: 500;
        font-size: 48px;
        line-height: 150%;
      }
      &-body{
        width: 100%;
        max-width: 600px;
        flex-direction: row;
        flex-wrap: wrap;
        &-input{
          background-color: $white;
          border-radius: 20px;
          padding: 20px 18px;
          width: 45%;
          margin: 2.5%;
          &:nth-child(3){
            width: 100%;
          }
          &-name{
            font-size: 18px;
            line-height: 21px;
            color: $font_input;
            position: absolute;
            left: 18px;
            width: auto;
            top: 20px;

            &.active{
              top: 8px;
              font-size: 12px;
              line-height: 14px;
            }
          }
          &>input, &>textarea{
            color: $font_input;
            border: unset;
            outline: none;
            width: 100%;
            resize: none;
          }
          &>textarea{
            width: 100%;
            height: 140px;
          }
        }
      }
      &-button{
        border: unset !important;
        width: 312px;
        padding: 31px 0;
        background-color: $yellow_d !important;
        border-radius: 25px;
        color: $yellow_l !important;
        font-weight: 500;
        font-size: 18px;
        line-height: 21px;
        cursor: pointer; 
        transition: 0.1s;
        &:hover{
          color: $white !important;
        }
      }
    }
  }
  .footer{
    background-color: $yellow;
    background-color: $yellow_bg;
    // padding: 5%;
    flex-direction: row;
    &:after{
      content: "";
      position: absolute;
      height: 1px;
      width: 100%;
      top: 0;
      background-color: $yellow;
      opacity: 0.3;
    }
    &-col{
      flex-direction: column;
      justify-content: flex-start;
      align-items: flex-start;
    }
    &-title{
      justify-content: flex-start;
      text-align: left;
      font-weight: bold;
      font-size: 60px;
      line-height: 130%;
      margin-bottom: 20px;
    }
    &-links{
      flex-direction: row;
      justify-content: flex-start;
      &.__new{
      justify-content: center;
      width: 100%;
        &>a{
          cursor: pointer;
          background-color: $white;
        }
      }
      &>a{
        height: 50px;
        width: 50px;
        border-radius: 50%;
        margin: 14px;
        background-color: $yellow;
      }
    }
    &-phone{
      align-items: flex-start;
      font-weight: 500;
      font-size: 50px;
      line-height: 150%;
      color: $yellow_l;
      margin-bottom: 20px;
    }
    &-address{
      align-items: flex-start;
      font-weight: 500;
      font-size: 25px;
      line-height: 150%;
      color: $yellow_l;
    }
    &-copy{
      align-items: flex-start;
      font-weight: 500;
      font-size: 25px;
      line-height: 150%;
      color: $yellow_l;
      margin-top: 30px;
    }
  }
@media screen and (min-width: 671px){
  .body-developer-body-column{
    left: 0 !important;
  }
}
@media screen and (max-width: 670px){
  .header{
    flex-direction: column;
  }
  .logo{
    margin-bottom: 32px;
  }
  .phone{
    &-main{
      font-size: 24px;
      line-height: 37px;
      margin-bottom: 16px;
      &>span{
        font-size: 32px;
      }
    }
    &-title{
      
    }
  }
  .body-projects{
    padding: 30px 1%;
    &-item{
      &-poject{
        margin: 15px 2%;
        &-ending{
          width: 80%;
          font-size: 21px;
          line-height: 24px;
        }
        &-name{
          font-size: 26px;
          line-height: 30px;
        }
      }
    }
    &-title{
      align-items: center;
      font-size: 24px;
      margin-bottom: 12px;
    }
  }
  .body-now{
    flex-direction: column-reverse;
    &-title{
      position: absolute;
      top: 0;
      font-size: 40px;
      line-height: 48px;
      text-align: center;
      white-space: normal;
      &>span{
        display: flex;
        // width: 100%;
        justify-content: center;
      }
    }
    &-content{
      width: 100%;
      margin-top: 25vh;
      padding: unset;
      &-pluses{
        &-title{
          text-align: left;
          &:after{
            top: 10%;
          }
        }
      }
      &>.button{
        margin-left: unset;
        max-width: 100%;
        padding: 12px;
      }
    }
    &-gallery{
      width: 100%;
      margin-top: 45vh;
      &>div{
        width: 100%;
        &.img_0{
          transform: translate(0, 0);
        }
        &.img_1{
          transform: translate(25%, 0) scale(0.8);
        }
        &.img_2{
          transform: translate(55%, 0) scale(0.7);
        }
      }
      
    }
  }
  .body-offices{
    flex-direction: column-reverse;
    &-title{
      align-items: center;
      position: absolute;
      top: 30px;
      font-size: 40px;
      line-height: 48px;
      text-align: center;
      white-space: normal;
    }
    &-map{
      width: 100%;
      &>iframe{
        width: 100% !important;
      }
    }
    &-content{
      width: 100%;
      margin-top: 30px;
      margin-left: unset;
      &-office{
        padding: 0 15px;
        &-location{
          color: $black;
          font-weight: 500;
          font-size: 22px;
          line-height: 26px;
        }
        &-working{
          font-weight: 300;
          font-size: 17px;
          line-height: 20px;
        }
      }
    }

  }
  .body-developer{
    padding: 5% 0;
    padding-bottom: 12.5vw;
    &-title{
      align-items: center;
      font-size: 40px;
      line-height: 48px;
      text-align: center;
    }
    &-pages{
      flex-direction: row;
      &-page{
        width: 12px;
        height: 12px;
        border-radius: 50%;
        margin-left: 15px;
        background-color: $yellow_shadow;
        cursor: pointer;
        &:firstt-child{
          margin-left: unset;
        }

        &.active{
          background-color: $yellow;
          transform: scale(1.25);
        }
      }
    }
    &-about{
      font-size: 20px;
    }
    &-body{
      flex-direction: column-reverse;
      align-items: flex-start;
      &-column{
        overflow-x: scroll;
        width: 300vw;
        margin-top: 55vh;
        flex-direction: row;
        max-width: unset;
        transition: 0.5s;
        &-text{
          padding: 0 2.5%;
          max-width: 100vw;
        }
      }
      &>img{
        transition: 0.5s;
        max-width: unset;
        top: 0;
        height: 50vh;
        position: absolute;
        transform: scaleX(2);
        left: 50%;
        width: 100%;
        // height: 50%;
      }
    }
  }
  .body-abouter{
    height: auto;
    justify-content: flex-start;
    margin-bottom: 25px;
    &>img{
      display: none;
    }
    &-content{
      padding-top: 10%;
      width: 100%;
      flex-direction: column;
      &-statistics{
        flex-direction: column;
        width: 100%;
        margin: unset;
        &-statistic{
          &-value{
            font-size: 50px;
            line-height: 61px;
          }
        }
      }
      &-info{
        align-items: center;
        width: 100%;
        &-title{
          text-align: center;
          font-weight: 800;
          font-size: 26px;
          line-height: 150%;
        }
        &-about{
          width: 100%;
          text-align: center;
          font-weight: 500;
          font-size: 18px;
          line-height: 21px;
          margin: 20px 0 20px;
        }
        &-button{
          // position: absolute;
          // bottom: 17.5vw;
        }
      }
    }
  }
  .body-form{
    padding: 16px 5%;
    &:before, &:after{
      top: -12vw;
    }
    &-title{
      font-size: 24px;
    }
    &-body{
      flex-direction: column;
      &-input{
        width: 100%;
        margin: 2.5% 0;
      }
    }
    &-button{
      padding: 16px 0;
      width: 100%;
      max-width: 100%;
    }
  }
  .footer{
    flex-direction: column;
    &-col{

    }
    &-title{
      justify-content: center;
      text-align: center;
      font-size: 24px;
      margin-bottom: unset;
    }
    &-links{
      justify-content: center;
    }
    &-phone{
      align-items: center;
      font-size: 22px;
    }
    &-address{
      align-items: center;
      font-size: 16px;
    }
    &-copy{
      align-items: center;
      font-size: 16px;
    }
  }
}
@keyframes open_logo {
  from {transform: rotateY(360deg); opacity: 0}
  to {transform: rotateY(0); opacity: 1}
}
@keyframes open_logo_rev {
  from {transform: rotateY(-180deg); opacity: 0}
  to {transform: rotateY(360deg); opacity: 1}
}
@keyframes open_img {
  from {transform: translateY(100%); opacity: 0}
  to {transform: translateY(0);opacity: 1}
}
@keyframes open_head {
  from {transform: translateX(100%);opacity: 0}
  70% {transform: translateX(0%);}
  80% {transform: translateX(1%);}
  to {transform: translateX(0);opacity: 1}
}
</style>
