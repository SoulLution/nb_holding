<template>
  <div class="main">
    <div class="header">
      <img src="/static/first.png">
      <div class="header-shadow"></div>
      <div class="header-down"></div>
    </div>
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

    <div class="body">
      <div class="body-abouter">
        <img src="/static/second_group.png">
        <div class="body-abouter-content">
          <div class="body-abouter-content-statistics">
            <div class="body-abouter-content-statistics-statistic" v-for="statistic in info.statistics">
              <div class="body-abouter-content-statistics-statistic-value">{{statistic.value}}+</div>
              <div class="body-abouter-content-statistics-statistic-name">{{statistic.name}}</div>
            </div>
          </div>
          <div class="body-abouter-content-info">
            <div class="body-abouter-content-info-title">{{info.title}}</div>
            <div class="body-abouter-content-info-about">{{info.about}}</div>
            <div class="body-abouter-content-info-button">{{info.button}}</div>
          </div>
        </div>
        <div class="mob body-abouter-content-info-button">{{info.button}}</div>
      </div>

      <div class="body-projects">
        <div class="body-projects-title">Проекты</div>
        <div class="body-projects-item">
          <div class="body-projects-item-poject" v-for="project in projects">
            <div class="body-projects-item-poject-ending">Сдан в {{' ' + project.ending + ' '}} году</div>
            <img class="body-projects-item-poject-img" :src="'/static/' + project.img">
            <div class="body-projects-item-poject-name">{{project.name}}</div>
          </div>
        </div>
      </div>
      <div class="body-developer" @mousedown="startTouch" @mouseup="endTouch">
        <div class="body-developer-title">О застройщике</div>
        <div class="body-developer-about">Осуществляем полный цикл работ от строительства до продажи квартир</div>

        <div class="body-developer-body">
          <div class="body-developer-body-column" :style="{left: '-' + (page * 100) + 'vw'}">
            <div class="body-developer-body-column-text" v-for="about in abouts"><div>{{about.div}}</div><div>{{about.first}}</div><div>{{about.all}}</div></div>
          </div>
          <img class="body-developer-body-img" src="/static/arrow_group.png" :style="{left: (-(page * 50) + 50) + '%'}">
        </div>

        <div class="body-developer-pages">
          <div class="body-developer-pages-page" :class="{'active': page === i-1}" @click="page = i-1" v-for="i in pages"></div>
        </div>

      </div>

      <form class="body-form" method="POST" @submint.prevent="sendEmail">
        <div class="body-form-title">Отправить запрос на сотрудничество </div>

        <div class="body-form-body">
          <label class="body-form-body-input" v-for="(input, i) in inputs" :for="'input-'+i">
            <div class="body-form-body-input-name" :class="{'active': input.focus || input.data}">{{input.name}}</div>
            <input :name="input.sub" :id="'input-'+i" @focus="input.focus = true" @blur="input.focus = false" v-model="input.data" v-if="i !== inputs.length-1" required autocomplete="off">
            <textarea :name="input.sub" :id="'input-'+i" @focus="input.focus = true" @blur="input.focus = false" v-model="input.data" v-else required autocomplete="off"></textarea>
          </label>
        </div>
        <input class="body-form-button" type="submit" value="Получить консультацию" @click="sendEmail">
      </form>

    </div>

    <div class="footer">
      <div class="footer-title">Мы всегда рады сотрудничеству!</div>
      <a href="tel:87070000092" class="footer-phone">8 707 000 00 92</a>
      <a href="geo:43.2593064,76.9297241,15" class="footer-address">г. Алматы, Достык 97 Б, 278 офис </a>
      <div class="footer-copy">help@nb-holding.kz</div>
    </div>
  </div>
</template>

<script>
  import Vue from "vue";
  export default Vue.extend({
    data: () => {
      return {
        touch: 0,
        page: 0,
        pages: 3,
        inputs: [
          {
            name: 'Имя',
            sub: 'name',
            data: '',
            focus: false
          },
          {
            name: 'Email',
            sub: 'Email',
            data: '',
            focus: false
          },
          {
            name: 'Напишите свой вопрос',
            sub: 'message',
            data: '',
            focus: false
          } 
        ],
        abouts: [
          {
            div: 'Начиная',  
            first: 'с 1997 года мы построили 26 жилых комплексов',
            all: 'в Алматы и еще 4 находятся в процессе возведения на данный момент. NB является одной из ведущих строительных компаний, которой доверяют тысячи людей по всей стране.'
          },
          {  
            div: 'Компания',  
            first: 'NB стала одной из первых строительных',
            all: 'компаний на территории нашей республики. Она была основана в 1997 году и успешно привлекает специалистов из разных отраслей и применяет их обширный опыт в своих проектах.'
          },
          { 
            div: 'Станьте',  
            first: 'частью семьи NB, выбрав апартаменты по ',
            all: 'своему вкусу в наших жилых комплексах!'
          }
        ],
        projects: [
          {
            name: 'ЖК Grand Avenue',
            ending: 2018,
            img: 'city.png'
          },
          {
            name: 'ЖК Grand Avenue',
            ending: 2018,
            img: 'city.png'
          }
        ],
        info: {
          title: 'ВЫБЕРИ СВОЮ КВАРТИРУ В ЕДИНОМ ЦЕНТРЕ ПРОДАЖ',
          about: 'выгодные цены напрямую от застройщика',
          button: 'Скачать планировки и узнать стоимость ',
          statistics: [
            {
              value: 6,
              name: 'лет мы строим для вас жилые дома'
            },
            {
              value: 400,
              name: 'семей проживают в наших ЖК'
            },
            {
              value: 400,
              name: 'семей проживают в наших ЖК'
            }
          ]
        }
      }
    },
    mounted(){
      document.body.ontouchstart = e => {
        this.touch = e.touches[0].clientX
      }
      document.body.ontouchend = e => {
        let x = e.changedTouches[0].clientX, index = 0

        if(this.touch - x > (document.body.clientWidth/2))
          index = 1
        else if(x -this.touch > (document.body.clientWidth/2))
          index = -1

        if(index)
          this.switchPage(index)
        this.touch = 0;
      }
    }, 
    created(){
      setInterval(()=>this.switchPage(1),10000)
    },
    methods:{
      startTouch(e){
        this.touch = e.touches[0].clientX;
      },
      endTouch(e){
        let x = e.changedTouches[0].clientX, index = 0

        if(this.touch - x > (document.body.clientWidth/2))
          index = 1
        else if(x -this.touch > (document.body.clientWidth/2))
          index = -1

        if(index)
          this.switchPage(index)
        this.touch = 0;
      },
      sendEmail(e){
        e.preventDefault();
        let data = {_replyto: 'help@nb-holding.kz'}
        for(let i = 0; i < this.inputs.length; i++)
          data[this.inputs[i].sub] = this.inputs[i].data
        this.$axios
         .post(
              "https://formspree.io/mzbgbolj",
              data
         )
         .then(res => {
            for(let i = 0; i < this.inputs.length; i++)
              this.inputs[i].data = ''
         });
         return false
       },
      toFormData: function(obj) {
        let formData = new FormData();
        for(let key in obj) {
            formData.append(key, obj[key]);
        }
        return formData;
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
  $yellow_092: rgba(200, 165, 100, 0.92);
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

  .main{
    
  }
  .header{
    height: 120vh;
    z-index: 0;
    &>img{
      height: 120vh;
      position: absolute;
      left: 0;
      top: 23px;
      width: auto;
    }
    &-shadow{
      height: 100%;
      background-color: $black_052;
      backdrop-filter: blur(5px);
    }
    &-down{
      display: none;
      width: 0;
      position: absolute;
      bottom: 67px;
      border-top: 15px solid $yellow;
      border-left: 15px solid transparent;
      border-right: 15px solid transparent;
      cursor: pointer;
      &:hover{
        transform: scale(1.2);
      }
    }
  }
  .logo{
    height: auto !important;
    position: absolute;
    top: 35vh;
    z-index: 2;
    flex-direction: row;
    width: auto;
    &-item{
      width: auto;
      &-row{
        width: auto;
        flex-direction: row;
        &>div{
          background-color: $white;
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
      margin-left: 28px;
      user-select: none;
      cursor: default;
      &-first{
        font-weight: bold;
        color: $white;
        margin-bottom: 8px;
        width: auto;
      }
      &-second{
        width: auto;
        color: $white;
      }
    }
  }
  .body{

    &>div{
      min-height: 100vh;
    }
    &-abouter{
      margin-top: -27.5vh;
      height: 150vh;
      &>img{
        position: absolute;
        top: 0;
        height: 100%;
        width: 100%;
      }
      &-content{
        min-height: 100vh;
        padding: 5%;
        // background-color: $yellow_092;
        flex-direction: row;
        &-statistics{
          width: auto;
          margin-left: 10%;
          &-statistic{
            padding: 0 80px;
            margin-bottom: 45px;
            &-value{
              color: $yellow_l;
              font-weight: 800;
              font-size: 40px;
              line-height: 49px;
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
          width: 80%;
          align-items: flex-start;
          &-title{
          text-align: left;
            width: auto;
            font-weight: 800;
            font-size: 50px;
            line-height: 150%;
          }
          &-about{
            text-align: left;
            width: auto;
            font-weight: 500;
            font-size: 24px;
            line-height: 28px;
            margin: 32px 0 84px;
          }
          &-button{
            width: 312px;
            padding: 12px 60px;
            background: $yellow_d;
            border-radius: 25px;
            color: $yellow_l;
            font-weight: 500;
            font-size: 18px;
            line-height: 21px;
            cursor: pointer; 
            transition: 0.1s;
            &.mob{
              display: none;
            }
            &:hover{
              color: $white;
            }
          }
        }
      }
    }
    &-projects{
      background-color: $yellow_bg;
      &:before, &:after{
        content: "";
        position: absolute;
        top: -12vw;
        left: 0;
        z-index: 1;
        border-bottom: 12.5vw solid $yellow_bg;
        border-left: 33vw solid transparent;
        border-right: 33vw solid transparent;
      }
      &:after{
        left: 66vw;
      }
      &-title{
        font-weight: bold;
        font-size: 40px;
        line-height: 48px;
        margin-bottom: 100px;
      }
      &-item{
        flex-direction: row;
        flex-wrap: wrap;
        &-poject{
          width: 100%;
          max-width: 400px;
          margin: 15px 6%;
          align-items: flex-start;
          &-ending{
            color: $white_d;
            font-weight: 600;
            font-size: 13px;
            line-height: 15px;
            background-color: $yellow_080;
            position: absolute;
            width: auto;
            padding: 12px 9px;
            top: 12px;
            left: -16px;
          }
          &-img{
            width: 100%;
          }
          &-name{
            margin: 5%;
            width: 33%;
            text-align: left;
            font-weight: 500;
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
        // color: $yellow_l;
        font-weight: bold;
        font-size: 40px;
        line-height: 48px;
      }
      &-about{
        font-size: 30px;
        line-height: 35px;
        margin: 40px;
      }
      &-body{
        flex-direction: row;
        &-column{
          &-text{
            flex-direction: row;
            flex-wrap: wrap;
            justify-content: flex-start;
            font-size: 22px;
            line-height: 27px;
            margin-bottom: 48px;
            &:nth-child(2)>div:first-child:after{
              width: 110%;
              right: -2.5%;
            }
            &>div{
              text-align: left;
              width: auto;
              margin: 0 5px;
              &:first-child:after{
                content: "";
                width: calc(100% + 6vw);
                right: 0;
                position: absolute;
                height: 37px;
                background: $yellow_080;
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
      padding-bottom: 15.5vw;
      &:before, &:after{
        content: "";
        position: absolute;
        top: -12vw;
        left: 0;
        z-index: 1;
        border-bottom: 12.5vw solid $yellow_092;
        border-left: 33vw solid transparent;
        border-right: 33vw solid transparent;
      }
      &:after{
        left: 66vw;
      }
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
    background-color: $yellow_bg;
    padding: 5%;
    &:before, &:after{
      content: "";
      position: absolute;
      top: -12vw;
      left: 0;
      z-index: 1;
      border-bottom: 12.5vw solid $yellow_bg;
      border-left: 33vw solid transparent;
      border-right: 33vw solid transparent;
    }
    &:after{
      left: 66vw;
    }
    &-title{
      font-weight: bold;
      font-size: 48px;
      line-height: 150%;
    }
    &-phone{
      font-weight: 500;
      font-size: 36px;
      line-height: 150%;
      color: $yellow_l;
      margin: 50px 0 40px;
    }
    &-address{
      font-weight: 500;
      font-size: 20px;
      line-height: 150%;
      color: $yellow_l;
    }
    &-copy{
      font-weight: 500;
      font-size: 20px;
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
  .body-projects-item-poject-name{
    width: 100%;
    justify-content: flex-start;
    align-items: flex-start;
  }
  .body-projects{
    
    &-title{
      font-size: 24px;
    }
  }
  .body-developer{
    padding: 5% 0;
    padding-bottom: 12.5vw;
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
  .body-abouter-content{
    padding-top: 10%;
    flex-direction: column-reverse;
    &-statistics{
      width: 100%;
      margin: unset;
    }
    &-info{
      align-items: center;
      width: 100%;
      &-title{
        font-size: 24px;
      }
      &-about{
        width: 100%;
        align-items: flex-start;
        font-size: 20px;
        margin: 20px 0 20px;
      }
      &-button{
        position: absolute;
        bottom: 17.5vw;
        display: none;
        &.mob{
          display: flex;
        }
      }
    }
  }
  .body-form{
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
      width: 100%;
      max-width: 100%;
    }
  }
  .footer{
    &-title{
      font-size: 24px;
    }
    &-phone{
      font-size: 22px;
    }
    &-address{
      font-size: 16px;
    }
    &-copy{
      font-size: 16px;
    }
  }
}
</style>
