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
        <img src="/static/second.png">
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
      <div class="body-developer">
        <div class="body-developer-title">О застройщике</div>
      </div>
    </div>
  </div>
</template>

<script>
  import Vue from "vue";
  export default Vue.extend({
    data: () => {
      return {
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
    }
  });
</script>

<style lang="scss" >
  
  $white: #FFFFFF;
  $white_d: #FFF2DB;
  $black: #1A1919;
  $black_052: rgba(0, 0, 0, 0.52);
  $font: #333333;
  $yellow: #C8A564;
  $yellow_l: #FFE8BD;
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
  div, label, a{
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
    height: 100vh;
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
    top: 25vh;
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
      &>img{
        position: absolute;
        top: 0;
        height: 100%;
        width: 100%;
      }
      &-content{
        min-height: 100vh;
        padding: 5%;
        background-color: $yellow_092;
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
            &:hover{
              color: $white;
            }
          }
        }
      }
    }
    &-projects{
      &-title{
        font-weight: bold;
        font-size: 40px;
        line-height: 48px;
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
            margin-left: 5%;
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
      background-color: $yellow_092;
      justify-content: flex-start;
      &-title{
        color: $yellow_l;
        font-weight: bold;
        font-size: 40px;
        line-height: 48px;
      }
    }
  }

</style>
