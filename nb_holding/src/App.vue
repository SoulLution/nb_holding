<template>
  <div class="main flex-col">


    <div class="popup items-center justify-center flex-col" :style="{zIndex: popup ? 10 : -1}">
      <div class="bg" @click="openPopup(0)" v-if="popup"></div>
      <svg class="close" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" @click="openPopup(0)" v-if="popup">
        <rect x="0.000244141" y="21.2131" width="30" height="3" transform="rotate(-45 0.000244141 21.2131)" fill="#C4C4C4"/>
        <rect x="2.12134" y="0.213135" width="30" height="3" transform="rotate(45 2.12134 0.213135)" fill="#C4C4C4"/>
      </svg>
      <form class="shop flex-col" @submit.prevent="sendShopForm" v-if="popup === 1">
        <span class="font-bold text-3xl">{{ippo.active[ippo.current].question}}</span>
        <div class="progress flex-col w-full">
          <div class="from-to w-full justify-between mt-12">
            <span>0%</span>
            <span class="font-bold absolute" :style="{left: (getProgress - 4) + '%'}" v-if="getProgress && getProgress !== 100">{{getProgress^0}}%</span>
            <span>100%</span>
          </div>
          <div class="bar"><div :style="{maxWidth: getProgress + '%'}"></div></div>
        </div>
        <span v-if="ippo.active[ippo.current].about">{{ippo.active[ippo.current].about}}</span>
        <div class="answers items-start">
          <div class="answer_item flex-col" :style="{marginLeft: ippo.current < i ? '100%' : ippo.current > i ? '-100%' : 0}" :key="i" v-for="(active, i) in ippo.active"v-if="i !== ippo.active.length - 1">
            <div class="active" :class="{'true': active.result.indexOf(j) !== -1}" @click="setResult(active, j)" :key="j" v-for="(answer, j) in active.answers" >{{answer}}</div>
          </div>
          <div class="flex-col items-start m-0" v-else>
            <input type="text" name="name" required placeholder="Имя" v-model="ippo.active[6].result[0]">
            <input v-mask="'+7 (###) ###-####'" :class="{'error' : error}" type="tel" name="phone" required placeholder="Номер" inputmode="numeric" v-model="ippo.active[6].result[1]">
          </div>
        </div>
        <div class="buttons mt-4" :class="!ippo.current ? 'justify-end' : 'justify-between'">
          <div class="w-auto m-0 items-center cursor-pointer" @click="ippo.current--" v-if="ippo.current !== 0">
            <svg width="16" height="11" viewBox="0 0 16 11" fill="none" xmlns="http://www.w3.org/2000/svg" style="transform: rotate(180deg); margin: 0.5rem;">
              <rect y="4.50708" width="14.4872" height="1" fill="#020102"/>
              <rect x="9.7915" width="7.08263" height="1" transform="rotate(45 9.7915 0)" fill="#020102"/>
              <rect x="9.33618" y="9.51538" width="7.08263" height="1" transform="rotate(-45 9.33618 9.51538)" fill="#020102"/>
            </svg>  
            <span>Назад</span>
          </div>
          <button class="w-auto m-0 items-center cursor-pointer" type="submit" v-if="ippo.current === ippo.active.length-1">Закончить</button>
          <div class="w-auto m-0 items-center cursor-pointer" @click="ippo.current++" v-else>
            <span>Пропустить</span>
            <svg width="16" height="11" viewBox="0 0 16 11" fill="none" xmlns="http://www.w3.org/2000/svg" style="margin: 0.25rem 0.5rem 0;">
              <rect y="4.50708" width="14.4872" height="1" fill="#020102"/>
              <rect x="9.7915" width="7.08263" height="1" transform="rotate(45 9.7915 0)" fill="#020102"/>
              <rect x="9.33618" y="9.51538" width="7.08263" height="1" transform="rotate(-45 9.33618 9.51538)" fill="#020102"/>
            </svg>  
          </div>
        </div>
      </form>
      <form class="download flex-col"@submit.prevent="sendDownloadForm()" v-else-if="popup === 2">
        <span class="font-bold text-3xl">Скачайте презентацию подходящих квартир</span>
        <div class="flex flex-col">
          <input type="text" name="name" required placeholder="Имя" v-model="download.name">
          <input v-mask="'+7 (###) ###-####'":class="{'error' : error}" type="tel" name="phone" required placeholder="Номер" inputmode="numeric" v-model="download.phone">
          <button type="sumbit">Скачать</button>
          <div class="justify-end">
            <img src="/static/download.png">
          </div>
        </div>
      </form>

      <form class="download flex-col"@submit.prevent="sendPrice()" v-else-if="popup === 3">
        <span class="font-bold text-3xl">Введите номер телефона, чтобы мы могли с вами связаться</span>
        <div class="flex flex-col">
          <input v-mask="'+7 (###) ###-####'" :class="{'error' : error}" type="tel" name="phone" required placeholder="Номер" inputmode="numeric" v-model="form.phone">
          <button type="sumbit">Отправить</button>
          <div class="justify-end">
            <img src="/static/download.png">
          </div>
        </div>
      </form>

      <form class="download flex-col"@submit.prevent="sendCall()" v-else-if="popup === 4">
        <span class="font-bold text-3xl">Введите номер телефона, чтобы мы могли с вами связаться</span>
        <div class="flex flex-col">
          <input v-mask="'+7 (###) ###-####'" :class="{'error' : error}" type="tel" name="phone" required placeholder="Номер" inputmode="numeric" v-model="form.phone">
          <button type="sumbit">Отправить</button>
          <div class="justify-end">
            <img src="/static/download.png">
          </div>
        </div>
      </form>

      <form class="download flex-col"@submit.prevent="" v-else-if="popup === 5">
        <span class="font-bold text-3xl">Спасибо за заполнение формы, в отделе продаж уже идет битва за такого классного клиента, как Вы! С Вами свяжется выживший менеджер)</span>
        <div class="flex flex-col items-center">
          <button @click="openPopup(0)">Закрыть</button>
        </div>
      </form>

    </div>



    <div class="header absolute">
      <div class="content flex-row justify-between">
        <div class="justify-center">
          <a href="#first" class="p-5 cursor-pointer text-white">Главная</a>
          <a href="#prezentatio" class="p-5 cursor-pointer text-white">Презентация</a>
          <a href="#projects" class="p-5 cursor-pointer text-white">Проекты</a>
        </div>
        <div class="justify-center">
          <img src="static/head.png">
        </div>
        <div class="justify-center burger flex-col items-end" :class="{'close': burger}" @click="burger = !burger">
          <div></div>
        </div>
        <div class="menu flex-row items-start p-24" :class="{'active': burger}">
          <div class="flex-col m-0 w-1/2">
            <h4>Меню</h4>
            <div class="flex-col">
              <a @click="burger = false" href="#first">Главная</a>
              <a @click="burger = false" href="#prezentatio">Презентация</a>
              <a @click="burger = false" href="#projects">Проекты</a>
            </div>
          </div>
          <div class="flex-col m-0 w-1/2">
            <h4></h4>
            <div class="flex-col">
              <a @click="burger = false" href="#apartments">Планировки</a>
              <a @click="burger = false" href="#builder">О компании</a>
              <a @click="burger = false" href="#map">Контакты</a>
            </div>
          </div>
        </div>
        <div class="justify-center">
          <a href="#apartments" class="p-5 cursor-pointer text-white">Планировки</a>
          <a href="#builder" class="p-5 cursor-pointer text-white">О компании</a>
          <a href="#map" class="p-5 cursor-pointer text-white">Контакты</a>
        </div>
      </div>
    </div>

    <div class="first" id="first">
      <div class="carusel">
        <img :src="'/static/carusel/' + i + '.jpg'" v-for="i in 7" :key="i">
        <img :src="'/static/carusel/' + i + '.jpg'" v-for="i in 7" :key="100+i">
      </div>
      <div class="content flex-col justify-center items-center h-screen text-white">
        <h1 class="text-center">Квартиры от<br>170.000 тг</h1>
        <button class="p-3" @click="openPopup(1)">Подобрать квартиру</button>
        <div class="info flex-row">
          <div class="w-1/3 flex-row justify-center"><h1>400</h1><div class="mob">семей</div><div class="desk w-auto mx-0">счастливых<br>семей</div></div>
          <div class="w-1/3 flex-row justify-center"><h1>6</h1><div class="mob">лет</div><div class="desk w-auto mx-0">лет на<br>рынке</div></div>
          <div class="w-1/3 flex-row justify-center"><h1>3</h1><div class="mob">проектов </div><div class="desk w-auto mx-0">завершенных<br>проектов</div></div>
        </div>
      </div>
    </div>

    <div class="prezentatio" id="prezentatio">
      <div class="content overflow-hidden flex-row justify-center items-center">
        <div class="flex-col w-1/3">
          <h2 class="desk">Презентация</h2>
          <span>Скачайте весь каталог проектов<br>в одном брендбуке</span>
          <button class="text-white" @click="openPopup(2)">Скачать</button>
        </div>
        <div class="flex-col w-2/3">
          <img src="/static/journal.png">
        </div>
        <h2 class="mob">Презентация</h2>
      </div>
    </div>

    <div class="projects" id="projects">
      <div class="content flex-row flex-wrap justify-start items-start">
        <h2 class="w-full">Проекты</h2>

        <div class="project m-0 w-1/2" :class="{'w-full': i === active.project, 'pl-4': i % 2 === 0, 'pr-4': i % 2 !== 0  }" :key="i" v-for="(project, i) in projects">
          <div class="flex flex-col">
            <div class="justify-between items-end"><h3>{{project.info.name}}</h3><span class="text-2xl">{{project.info.city}}</span></div>
            <div class="img justify-center items-center">
              <span>Фото</span>
              <img :src="'/static/projects/' + project.folder + '/' + project.info.img" v-if="project.info.img  ">
              <div class="price" v-if="project.info.min_price">{{project.info.min_price}}</div>
              <div class="shower absolute flex-col justify-center" v-if="project.info.pluses.length">
                <div class="flex-col">
                  <h4>Статус: {{project.info.status}}</h4>
                  <h4 v-if="project.info.ending">Срок сдачи - {{project.info.ending}}</h4>
                  <h4 class="mt-10">Плюсы</h4>
                  <span v-for="plus in project.info.pluses" :key="plus">{{plus}}</span>
                </div>
                <div class="flex-col desk">
                  <span class="next"><a href="#apartments">Смотреть планировки</a></span>
                  <button @click="openPopup(2, project.info.prezentatsia)">Презентация</button>
                </div>
              </div>
            </div>
            <div class="flex-col mob">
              <span class="next my-4" v-if="project.info"><a href="#apartments">Смотреть планировки</a></span>
              <button class="p-4" v-if="project.info.pluses.length" @click="openPopup(2, project.info.prezentatsia)">Презентация</button>
            </div>
          </div>  
        </div>

      </div>
    </div>

    <div class="apartments" id="apartments">
      <div class="content flex-col items-start">
        <h2>Планировки</h2>
        <div class="flex-row flex-wrap w-2/3 justify-start items-start mt-16 m-0">
          <div class="active m-0 mb-4 mr-16 w-auto whitespace-no-wrap cursor-pointer" :class="{'true': active.for_appartments == i}" :key="i" @click="changeForAppart(i)" v-for="(appartments, i) in projects" v-if="appartments.info.prices[2]">{{appartments.info.name}}</div>
        </div>
        <div class="flex-row justify-start items-start mt-32">
          <div class="m-0" :class="{'w-0': key != active.rooms}" v-for="(project, key) in projects[active.for_appartments].info.prices" :key="key">
            <img class="w-4/5" :src="'/static/projects/' + projects[active.for_appartments].folder + '/plans/block_' + key + '/' + size + '.png'" v-for="(price, size) in project" :key="size" v-if="key == active.rooms && size === active.size">
          </div>
          <div class="flex-col justify-start w-1/5">
            <span>{{projects[active.for_appartments].info.block_type}}</span>
            <div class="flex-row justify-start flex-wrap" v-if="projects[active.for_appartments].info.prices[2]">
              <div class="active cursor-pointer w-auto p-4 m-0" :class="{'true': active.rooms == key}" v-for="(j, key) in projects[active.for_appartments].info.prices" @click="changeRooms(key)" :key="key">{{key}}</div>
            </div>
            <span>Площадь</span>
            <div class="flex-row justify-start items-start flex-wrap">
              <div class="active cursor-pointer w-1/2 py-4 px-2 m-0 whitespace-no-wrap" :class="{'true': active.size == j}" :key="j" v-for="(item, j) in projects[active.for_appartments].info.prices[active.rooms]" @click="changeSize(j)">{{j}}</div>
            </div>
            <button @click="openPopup(3)">Рассчитать<br>стоимость</button>
          </div>
        </div>
      </div>
    </div>

    <div class="builder mt-16" id="builder">
      <div class="content flex-row justify-between items-start">
        <div class="flex-col m-0 pr-16 w-2/4">
          <span>Мы, строительная компания «NB HOLDING» - команда креативных и влюбленных в архитектуру людей. За плечами каждого члена компании серьезные знания и большая практика. 
7 лет мы строим жилую и коммерческую недвижимость в Алматы, Атырау, Актау и Актобе. 
</span>
          <span class="mt-12">Мы тщательно изучаем новые фасадные материалы, посещая мировые выставки. Следим за инновационными инженерными и техническими решениями. Мы работаем с одной из лучшей компанией в сфере проектирования зданий в Казахстане. </span>
          <span class="mt-12">Наши проекты – говорят за нас. В наших домах живут наши семьи, родственники и друзья.</span>
          <span class="mt-12">Наши дворы всегда закрыты от машин и посторонних людей. Дети играют в безопасности, взрослые отдыхают в тени деревьев. Двери в подъездах у нас прозрачные, чтобы жители видели, что происходит внутри и снаружи. Вход находится на уровне земли, чтобы было удобно мамам с колясками, пожилым людям и велосипедистам. В планировках мы любим эргономику: никаких узких коридоров и ненужных углов. Часто мы заранее предусматриваем гардеробные зоны и ниши для шкафов. Нам нравятся большие окна, которые наполняют комнату естественным светом и визуально увеличивают её объём. А еще, в каждый свой проект мы включаем варианты двухуровневых квартир и апартаментов с терассой.</span>
          <span class="mt-12">Во главу угла мы ставим не обогащение, мы видим свою миссию в изменении жизни людей к лучшему, создавая качественное и комфортное жилье, с развитой инфраструктурой за приемлемый бюджет. </span>
          <h4 class="mt-16">Команда NB HOLDING</h4>
        </div>
        <div class="img w-2/4 m-0">
          <div class="m-0 justify-center items-center flex-col">
            <!-- <span>Фото</span> -->
            <img src="/static/about_us.JPG">
          </div>
        </div>
      </div>
    </div>

    <div class="map" id="map">
      <div class="content flex-row justify-end">
        <img :src="'/static/'+ office.img" v-for="(office, i) in offices" v-show="active.office === i" :key="i">
        <div class="flex-col m-0 my-auto w-1/3">
          <h2 class="mb-20">Мы всегда Вам рады</h2>
          <h4>Адрес</h4>
          <div class="flex-row mt-4">
            <div class="active" :class="{'true': active.office === i}" @click="active.office = i" :key="i" v-for="(office, i) in offices">{{office.city}}</div>
          </div>
          <span v-html="offices[active.office].address" />
          <div class="flex-row mt-20">
            <div class="flex-col"><h4>Телефон</h4><a href="tel:+7 (747) 094 11 61">{{offices[active.office].phone}}</a></div>
            <div class="flex-col"><h4>Время работы</h4><div v-html="offices[active.office].time" /></div>
          </div>
          <button @click="openPopup(4)">Связаться</button>
        </div>

      </div>
    </div>

    <div class="footer" id="footer">
      <div class="content items-start">
        <div class=" m-0 w-2/12 desk">
          <img src="/static/head.png">
        </div>
        <div class="flex-col w-2/12 desk">
          <h4>Меню</h4>
          <div class="flex-col">
            <a href="#first">Главная</a>
            <a href="#prezentatio">Презентация</a>
            <a href="#projects">Проекты</a>
          </div>
        </div>
        <div class="flex-col w-2/12 desk">
          <h4></h4>
          <div class="flex-col">
            <a href="#apartments">Планировки</a>
            <a href="#builder">О компании</a>
            <a href="#map">Контакты</a>
          </div>
        </div>
        <div class="flex-col w-2/12 desk">
          <h4></h4>
          <div class="flex-col">
            <a href="https://instagram.com/nb_holding?igshid=1v561aoba09ap">Instagram</a>
            <a href="https://wa.me/77473001777?text=Здравствуйте+,+хочу+получить+подробную+консультацию">WhatsApp</a>
          </div>
        </div>


        <div class="flex-row w-2/12 mob">
          <div class="flex-row mt-8 justify-between">
            <a href="https://instagram.com/nb_holding?igshid=1v561aoba09ap">Instagram</a>
            <a href="https://wa.me/77473001777?text=Здравствуйте+,+хочу+получить+подробную+консультацию">WhatsApp</a>
          </div>
        </div>
        <div class="flex-row w-2/12 mob">
          <div class="flex-col">
            <a href="#first">Главная</a>
            <a href="#prezentatio">Презентация</a>
            <a href="#projects">Проекты</a>
          </div>
          <div class="flex-col">
            <a href="#apartments">Планировки</a>
            <a href="#builder">О компании</a>
            <a href="#map">Контакты</a>
          </div>
        </div>
        <h4 class="mt-8 mob">Меню</h4>
        <form class="flex-col w-3/12" @submit.prevent="sendCall">
          <h4>Мы перезвоним Вам</h4>
          <input v-mask="'+7 (###) ###-####'" :class="{'error' : error}" type="tel" name="phone" placeholder="Номер" inputmode="numeric" v-model="form.phone">
          <button type="sumbit">Жду звонка</button>
        </form>
      </div>
    </div>

  </div>
</template>

<script>
  Object.prototype.getFirstProperty = function () {
    for (var i in this) {
      return i;
    }
  }
  import Vue from "vue";
  export default Vue.extend({
    data(){
      return{
        popup: 0,
        download: {
          name: '',
          phone: ''
        },
        load: false,
        error: false,
        ippo:{
          current: 0,
          active: [],
          def: [
            {
              question: '1. В каком городе ищете квартиру?',
              result: [],
              arr: false,
              answers: ['Актау', 'Атырау','Алматы', 'Актобе']
            },
            {
              question: '2. Для каких целей ищете квартиру?',
              result: [],
              arr: false,
              answers: ['Для жизни', 'Для инвестиций']
            },
            {
              question: '3. Выберите необходимую площадь квартиры:',
              result: [],
              arr: false,
              answers: ['Студия до 40м2', '1-комн квартира 40 – 60м2','2-комн квартира 60 – 90м2', '3-комн квартира 100 – 120м2', 'Просторная квартира свыше 150м2']
            },
            {
              question: '4. Укажите предполагаемый бюджет:',
              result: [],
              arr: false,
              answers: ['до 6 млн тенге', 'от 6 млн до 10 млн тенге','от 10 млн до 20 млн тенге', 'от 20 млн до 30 млн тенге', 'от 30 млн и выше']
            },
            {
              question: '5. Вид оплаты:',
              result: [],
              arr: false,
              answers: ['наличными', 'в рассрочку','в ипотеку']
            },
            {
              question: '6. Выберите дополнительные детали:',
              result: [],
              arr: false,
              answers: ['Красивый вид из окон', 'Высокие потолки','Выход на террасу/лоджию', 'Наличие гардеробной']
            },
            {
              question: 'Найдено 8 вариантов',
              result: ['',''],
              about: 'Внесите свои данные, мы свяжемся с Вами для уточнения деталей и отправим презентацию и готовые планировочные решения подходящих квартир.'
            }
          ]
        },
        burger: false,
        form:{
          phone: ''
        },
        prezentatsia: '',
        active: {
          project: 0,
          for_appartments: 0,
          rooms: 1,
          size: '41,63',
          office: 0,
        },
        offices: [
          {
            city: 'Актау',
            time: 'с 10:00 до 19:00',
            img: 'map_actau.png',
            phone: '+7 (747) 094 11 61',
            address: '28 микрорайон,47 участок.<br>ЖК «Grand Avenue»'
          },
          {
            city: 'Атырау',
            time: 'с 10:00 до 19:00',
            img: 'map_atyrau.png',
            phone: '+7 (747) 094 11 22',
            address: 'Махамбет Утемисов, 125Б.<br>ЖК «Lagoon Residence»'
          },
        ],
        projects: [
          {
            folder: 'grand-avenue',
            info: '/static/projects/grand-avenue/info.json'
          },
          {
            folder: 'inara',
            info: '/static/projects/inara/info.json'
          },
          {
            folder: 'family-town',
            info: '/static/projects/family-town/info.json'
          },
          {
            folder: 'nb-towers',
            info: '/static/projects/nb-towers/info.json'
          },
          {
            folder: 'nb-apartments',
            info: '/static/projects/nb-apartments/info.json'
          },
          {
            folder: 'left_project',
            info: '/static/projects/left_project/info.json'
          },
          {
            folder: 'right_project',
            info: '/static/projects/right_project/info.json'
          }
        ]
      }
    },
    computed:{
      getProgress(){
        return 100 / (this.ippo.def.length - 1) * this.ippo.current
      }
    },
    watch:{
      burger:{
        handler(newData){
          document.getElementsByTagName('html')[0].style.overflow = newData ? 'hidden' : 'hidden auto'
        }
      }
    },
    async created(){
      for(let project of this.projects)
        project.info = await this.getInfoData(project.info)
    },
    methods:{
      getInfoData(path){
        return new Promise(resolve => {
            this.$axios.get(path)
          .then( res => {
            resolve(res.data)
          })
        })
      },
      sendPrice(){
        let data = {
          type: 3,
          fio: '',
          phone: this.form.phone,
          zk: this.projects[this.active.for_appartments].folder,
          rooms: this.active.rooms,
          size: this.active.size
        }
        this.sender(data)
      },
      sendCall(){
        let data = {
          type: 2,
          fio: '',
          phone: this.form.phone
        }
        this.sender(data)
      },
      sendDownloadForm(){
        let data = {
          type: 0,
          name: this.download.name,
          phone: this.download.phone
        }
        this.sender(data, true)
      },
      sendShopForm(){
        let data = {
          type: 1,
          name: this.ippo.active[6].result[0],
          phone: this.ippo.active[6].result[1],
          city: this.ippo.active[0].result.length ? this.ippo.active[0].answers[this.ippo.active[0].result[0]] : '',
          target: this.ippo.active[1].result.length ? this.ippo.active[1].answers[this.ippo.active[1].result[0]] : '',
          size: this.ippo.active[2].result.length ? this.ippo.active[2].answers[this.ippo.active[2].result[0]] : '',
          price: this.ippo.active[3].result.length ? this.ippo.active[3].answers[this.ippo.active[3].result[0]] : '',
          payment: this.ippo.active[4].result.length ? this.ippo.active[4].answers[this.ippo.active[4].result[0]] : '',
          pluses: this.ippo.active[5].result.length ? this.ippo.active[5].answers[this.ippo.active[5].result[0]] : ''
        }
        this.sender(data)
      },
      sender(data, down){
        this.error = false
        let arr = [700,701,702,703,704,705,706,707,708,709,747,750,751,760,761,762,763,764,771,775,776,777,778]
        if(!arr.includes(parseInt(data.phone.substr(4,3))))
          this.error = true
        else if(!this.load){
          this.error = false
          this.load = true
          data = this.changeData(data)
          this.$axios
          .post(
                "mail_dev.php",
                data
          )
          .then(res => {
            if(down){
              let a = document.createElement('a')
              a.setAttribute('href', this.prezentatsia.href)
              a.setAttribute('download', this.prezentatsia.name)
              a.click()
            }
          })
          .catch(err => {
              new Error(err)
          })
          .finally( () => this.openPopup(5))
        }
      },
      changeData(data){
        let formData = new FormData()
        Object.keys(data).forEach(key => {
          formData.append(key, data[key])
        })
        return formData
      },
      setResult(step, index){
        if(step.arr){
          let of = step.result.indexOf(index)
          if(of !== -1)
            step.result.splice(of, 1)
          else
            step.result.push(index)
        }
        else{
          step.result = [index]
          this.ippo.current++
        }
      },
      openPopup(type, preza){
        if(5 === this.popup)
          window.top.location="https://nb-holding.kz/thankyou"
        else 
        if(type === 1){
          this.ippo.current = 0
          this.ippo.active = JSON.parse(JSON.stringify(this.ippo.def))
        }
        if(preza)
          this.prezentatsia = preza
        else
          this.prezentatsia = ''
        this.popup = type
        let html = document.getElementsByTagName('html')[0]
        if(type)
          html.style.overflowY = 'hidden'
        else
          html.style.overflowY = 'scroll'
      },
      changeSize(index){
        this.active.size = index
      },
      changeRooms(index){
        this.active.rooms = index
        this.active.size = this.projects[this.active.for_appartments].info.prices[this.active.rooms].getFirstProperty()
      },
      changeForAppart(index){
        this.active.for_appartments = index
        this.active.rooms = Object.keys(this.projects[this.active.for_appartments].info.prices)[0]
        this.active.size = this.projects[this.active.for_appartments].info.prices[this.active.rooms].getFirstProperty()
      }
    }
  })
</script>

<style lang="scss">
  html {
    scroll-behavior: smooth;
  }
  body{
    margin: 0;
    color: #020102;
  }
  *{
    font-size: 1.125rem;
  }
  div, form{
    display: flex;
    width: 100%;
    max-width: 100vw;
    margin: auto;
    box-sizing: border-box;
    position: relative;
  }
  .desk{
    display: flex;
  }
  .mob{
    display: none;
  }
  .main{
    &>div{
      width: 100vw;
    }
  }
  .content{
    width: 100%;
    max-width: calc(1170px + 4rem);
    padding: 0 2rem;
  }
  .popup{
    position: fixed;
    left: 0;
    top: 0;
    height: 100vh;
    width: 100vw;
    z-index: 10;
    &>.bg{
      position: absolute;
      left: 0;
      top: 0;
      width: 100%;
      height: 100%;
      background-color: #00000056;
      max-width: 100vw;
      padding: 0;
    }
    & .bar{
      height: 57px;
      width: 100%;
      background: #C4C4C427;
      margin-bottom: 12px;
      overflow: hidden;
      &>div{
        height: 100%;
        width: 100%;
        max-width: 0;
        margin: 0;
        transition: 0.3s;
        background-color: #FEEF3A;
      }
    }
    & .close{
      z-index: 5;
      transform: translate(236px, -12px);
      cursor: pointer;
    }
    & .answers{
      overflow: hidden;
    }
    & .answer_item{
      max-width: 100%;
      min-width: 100%;
      margin: 0;
      transition: 0.3s;
      &>div{
        font-size: 22px;
        line-height: 221.4%;
        margin-bottom: 14px;
        width: auto;
        margin: 0;
        &.true:after{
          background-color: #FEEF3A;
        }
        &:hover:after{
          max-width: 100%;
        }
      }
    }

    & img{
      z-index: 0;
      transform: translate(-10%, 5%);
      width: auto;
      max-width: max-content;
    }
    & input{
      margin-top: 2rem;
      background-color: transparent;
      border-bottom: 1px solid #020102;
      outline: none;
      width: 70%;
      &::placeholder{
        color: #020102;
        opacity: 0.51;
        font-size: 0.75rem;
      }
    }
    & button{
      padding: 0.5rem 1rem;
      max-width: 154px;
      z-index: 1;
    }
    &>form{
      display: flex;
      background-color: white;
      width: 100%;
      margin: 0;
      max-width: 475px;
      padding: 45px 28px;
      padding-right: 16px;
      overflow: hidden;
      &>span{
        font-size: 1.5rem;
        line-height: 125%;
        position: relative;
        z-index: 1;
      }
      &.download{
        overflow: hidden;
        & button{
          margin-top: 2rem;
        }
        &:before{
          content: "";
          position: absolute;
          max-height: 40px;
          max-width: 40px;
          min-height: 40px;
          min-width: 40px;
          border-radius: 50%;
          right: 0;
          top: 0;
          transform: translate(30%, -30%);
          background-color: #FD9D28;
        }
        &:after{
          content: "";
          position: absolute;
          max-height: 255px;
          max-width: 255px;
          min-height: 255px;
          min-width: 255px;
          border-radius: 50%;
          left: 0;
          bottom: 0;
          transform: translate(-50%, 50%);
          background-color: #F1DF00;
          z-index: 0;
        }
      }
    }
  }
  .burger{
    display: none;
    width: 32px;
    &>div, &:before, &:after{
      content: "";
      margin: 0;
      margin-bottom: 7px;
      height: 2px;
      width: 100%;
      background-color: #FCFDFF;
      transition: 0.3s;
    }
    &:after{
      width: 66.66% !important;
    }
    &.close{
      background-color: transparent !important;
      &>div{
        opacity: 0;
      }
      &:before{
        transform: rotate(45deg) translate(40%);
      }
      &:after{
        width: 100% !important;
        transform: rotate(-45deg) translate(40%);
      }
    }
  }
  .menu{
    display: none;
  }
  .header{
    z-index: 1;
    padding: 2.75rem 0;
    & a{
      font-weight: 500;
      font-size: 1.125rem;
      line-height: 1.375rem;
      white-space: nowrap;
    }
  }
  .first{
    z-index: 0;
    flex-direction: column;
    height: 100vh;
    & .carusel{
      height: 100%;
      min-width: 1675vw;
      position: absolute;
      height: 0;
      top: 0;
      overflow: visible;
      animation: mover 25s linear infinite;
      z-index: 0;
      margin: 0;
      &>img{
        height: 100vh;
        min-width: 100vw;
        max-width: 100vw;
        position: sticky;
        top: 0;
      }
    }
    & button{
      width: 260px;
      margin-top: 3.375rem
    }
    &>*{
      z-index: 2;
    }
    &:after{
      content: "";
      min-height: 255px;
      min-width: 255px;
      max-height: 255px;
      max-width: 255px;
      border-radius: 50%;
      background-color: #F1DF00;
      position: absolute;
      right: 7px;
      bottom: 0;
      transform: translateY(63%);
      z-index: 1;
    }
    &:before{
      content: "";
      position: absolute;
      left: 0;
      top: 0;
      width: 100%;
      height: 100%;
      opacity: 0.7;
      background: radial-gradient(50% 50% at 50% 50%, rgba(46, 46, 46, 0.79) 0%, #000000 100%);
      z-index: 1;
    }
  }
  .info{
    padding: 2.25rem 5rem;
    position: absolute;
    bottom: 0;
    transform: translateY(50%);
    background-color: white;
    box-shadow: 5px 40px 66px #D8D8D85f;
    color: #020102;
    & h1{
      margin-right: 1rem;
    }
    & div{
      font-weight: 500;
      font-size: 22px;
    }
  }

  .prezentatio{
    min-height: 100vh;
    margin-bottom: 10vh;
    & img{
      transform: scale(1.35);
    }
    & span{
      margin-top: 1.875rem;
    }
    & button{
      padding: 0.75rem;
      max-width: 170px;
      margin-top: 5rem;
    }
    &>.content>*:first-child{
      z-index: 1;
    }

    &:before{
      content: "";
      min-height: 40px;
      min-width: 40px;
      max-height: 40px;
      max-width: 40px;
      border-radius: 50%;
      background-color: #FD9D28;
      position: absolute;
      right: 15%;
      top: 15%;
    }
    &:after{
      content: "";
      position: absolute;
      left: 0;
      bottom: 0;
      height: 100%;
      max-height: 76px;
      width: 100%;
      max-width: 360px;
      background-image: url('/static/balls.svg');
      background-repeat: no-repeat;
      background-position: -20% 0;
    }
  }

  .projects{
    z-index: 0;
    margin-bottom: 10vh;
    & h3{
      font-size: 2rem;
    }
    & img{
      width: 100%;
      height: 100%;
      z-index: 1;
    }
    & .price{
      color: #FCFDFF;
      position: absolute;
      left: 0;
      top: 5rem;
      padding: 0.875rem;
      width: auto;
      background-color: #00000096;
      z-index: 2;
    }
    & .img{
      width: 100%;
      height: 385px;
      background-color: #000000b3;
      overflow: hidden;

      &>span{
        z-index: 0;
        position: absolute;
        font-weight: 500;
        font-size: 2.5rem;
        color: #3C3C3C;
        opacity: 0.65;
      }
    }
    & .project:hover{
      & .shower{
        transform: translateX(0);
      }
    }
    & .w-full{
      padding: 0;
      & .shower{
        transform: translateX(0);
      }
      & .img{
        height: 578px;
      }
    }

    &:after{
      content: "";
      position: absolute;
      right: 0;
      top: 0;
      height: 100%;
      max-height: 76px;
      width: 100%;
      transform: translateY(130vh);
      max-width: 360px;
      background-image: url('/static/balls.svg');
      background-repeat: no-repeat;
      background-position: 20% 0;
      z-index: -1;
    }
  }
  .shower{
    color: #FCFDFF;
    padding: 2.5rem;
    padding-right: 1.25rem;
    z-index: 2;
    right: 0;
    top: 0;
    height: 100%;
    width: 350px;
    background-color: #00000096;
    transform: translateX(100%);
    transition: 0.3s;
    & button{
      margin-top: 2.25rem;
      padding: 0.75rem;
      max-width: 170px;
    }
    & span{
      line-height: 40px;
    }
  }
  .apartments{
    margin-bottom: 10vh;
    & img{
      height: 100%;
      min-height: 150px;
    }
    &:before{
      content: "";
      position: absolute;
      left: 0;
      top: 0;
      height: 100%;
      max-height: 611px;
      width: 100%;
      max-width: 60px;
      transform: translateY(-50%);
      background-color: #FEEF3A;
    }

    &:after{
      content: "";
      position: absolute;
      right: 0;
      top: 0;
      height: 100%;
      max-height: 76px;
      width: 100%;
      max-width: 360px;
      background-image: url('/static/balls.svg');
      background-repeat: no-repeat;
      background-position: 20% 0;
    }
    & button{
      max-width: 200px;
      padding: 0.625rem;
      margin-top: 5rem;
    }
    & span{
      margin-top: 3rem;
      font-weight: 500;
      font-size: 1rem;
      color: #020102;
      opacity: 0.67;
    }
  }

  .builder{
    z-index: 0;
    & .img{
      overflow: hidden;

      &:before {
        content: "";
        position: absolute;
        width: 450px;
        height: 1px;
        background: #020102;
        top: 15%;
        left: 0;
        transform: translateX(-85%);
        z-index: 0;
      }
      &>div{
        z-index: 1;
        background-color: #acacac;
      }
      & span{
        z-index: 0;
        position: absolute;
        font-weight: 500;
        font-size: 2.5rem;
        color: #3C3C3C;
      }
    }
  }

  .map{
    padding-bottom: 50vh;
    overflow: hidden;
    &:before{
      content: "";
      position: absolute;
      right: 0;
      top: 0;
      height: 100%;
      max-height: 611px;
      width: 100%;
      max-width: 60px;
      transform: translateY(-25%);
      background-color: #FEEF3A;
    }
    &>.content{
      height: 100vh;
      position: unset;
    }
    & .active{
      padding-bottom: 0.5rem;
      font-size: 1.125rem;
      line-height: 1.375rem;
    }
    & span{
      font-size: 0.875rem;
      line-height: 1.0625rem;
      color: #020102;
      opacity: 0.7;
    }
    & button{
      padding: 0.75rem;
      padding-bottom: 0.875rem;
      margin-top: 7.5rem;
      max-width: 165px;
    }
    & img{
      max-height: 100vw;
      max-width: 100vw;
      position: absolute;
      left: 0;
    }
  }

  .footer{
    color: #FCFDFF;
    padding: 2.5rem 0;
    background-color: #4F5354;
    & a{
      margin-bottom: 1rem;
    }
    & h4{
      height: 1.5rem;
      margin-bottom: 2.5rem;
    }
    & input{
      margin-bottom: 2.5rem;
      background-color: transparent;
      border-bottom: 1px solid #FCFDFF;
      outline: none;
      &::placeholder{
        color: #FCFDFF;
        opacity: 0.51;
        font-size: 0.75rem;
      }
    }
    & button{
      padding: 0.5rem 1rem;
      max-width: 154px;
    }
  }
  .next{
    display: flex;
    flex-direction: row;
    align-items: center;
    &:after{
      content: "";
      margin-left: 0.75rem;
      margin-top: 5px;
      width: 16px;
      height: 11px;
      background-image: url('/static/arrow.svg');
    }
  }
  .active{
    font-weight: 500;
    font-size: 1.5rem;
    color: #020102;
    cursor: pointer;
    &:after{
      content: "";
      position: absolute;
      left: 0;
      bottom: 0;
      height: 3px;
      width: 100%;
      max-width: 0;
      background-color: #FD9D28;
      transition: 0.3s;
    }
    &.true{

      &:after{
        max-width: 100%;
      }
    }
  }
  h1{
    font-weight: bold;
    font-size: 5rem;
  }
  h2{
    font-weight: bold;
    font-size: 3.75rem;
  }
  h3{
    font-weight: bold;
    font-size: 2.5rem;
  }
  h4{
    font-weight: bold;
    font-size: 1.25rem;
  }
  button{
    color: #FCFDFF;
    background: linear-gradient(242.4deg, #FD9D28 1.04%, #FF920E 77.34%);
    border: none;
    outline: none;
    font-size: 1.125rem;
    line-height: 1.375rem;
    position: relative;
    display: flex;
    justify-content: center;
    align-items: center;
    overflow: hidden;
    &:before{
      content: "";
      position: absolute;
      top: -50vh;
      height: 100vh;
      width: 100vh;
      background-color: transparent;
      border-top: 10px solid white;
      border-left: 10px solid white;
      transform: rotate(45deg);
      filter: blur(2px);
    }
    &:after{
      content: "";
      position: absolute;
      bottom: -50vh;
      height: 100vh;
      width: 100vh;
      background-color: transparent;
      border-bottom: 10px solid white;
      border-right: 10px solid white;
      transform: rotate(45deg);
    }
    &:hover{
      &:before{
        transition: 0.5s;
        top: 25vh;
      }
      &:after{
        transition: 0.75s;
        bottom: 24.5vh;
      }
    }
  }

  @media (max-width: 1124px){
    :root {
      font-size: 12px;
    }
    .popup{
      & .close{
        top: 0.5rem;
        right: 0.5rem;
        position: absolute;
        transform: none;
      }
      &>form{
        width: 90%;
        max-height: 90vh;
        overflow: hidden auto;
      }
    }
    .desk{
      display: none;
    }
    .mob{
      display: flex;
    }
    .header{
      z-index: 5;
      &>.content{
        &>div{
          width: auto;
          margin: 0;
          &.burger{
            z-index: 2;
            height: 38px;
            width: 38px;
            padding: 0.5rem;
            padding-top: 0.75rem;
            border-radius: 50%;
            display: flex;
            background-color: #00000086;
            position: fixed;
            top: 1rem;
            right: 2rem;
          }
          &.menu{
            z-index: 1;
            display: flex;
            height: 100vh;
            width: 100vw;
            padding: 2rem;
            padding-top: 5rem;
            position: fixed;
            right: 0;
            top: 0;
            background-color: #4F5354;
            transform: translateY(-100%);
            transition: 0.3s;
            color: #FCFDFF;
            & h4{
              height: 20px;
              font-size: 20px;
              margin-bottom: 46px;
            }
            & a{
              font-size: 18px;
              margin-bottom: 16px;
            }
            &.active{
              transform: translateY(0%);
            }
          }
          &:first-child, &:last-child{
            display: none;
          }
        }
      }
    }
    .first{
      &>.content{
        justify-content: space-between;
        padding: 20vh 2rem;
        & button{
          width: 100%;
          padding: 13px 12px 15px;
        }
      }
    }
    .info{
      padding: 1rem;
      flex-wrap: wrap;
      max-width: 95%;
      justify-content: space-between;
      &>div{
        width: auto;
      }
      & h1{
        font-size: 30px;
        margin-right: 0.5rem;
      }
      & span{
        font-size: 14px;
      }
    }
    .prezentatio{
      &>.content{
        padding-top: 10vh;
        padding-bottom: 10vh;
        flex-direction: column-reverse;
        & span{
          font-size: 2rem;
        }
        &>div{
          width: 100%;
        }
      }
    }
    .projects{
      & .project {
        padding: unset;
      }
      & .w-full{
        & .shower{
          transform: translateX(100%);
        }
        & :hover .shower{
          transform: translateX(0);
        }
      }
      &:after{
        z-index: -1;
      }
      & .w-1\/2{
        width: 100%;
        max-width: 500px;
        margin: 0 auto;
      }
      & .img{
        max-height: 220px;
      }
      
      & span{
        font-size: 20px;
      }
      & button{
        max-width: 155px;
        margin-bottom: 2rem;
      }
    }
    .shower{
      width: 80%;
      &>*>*{
        margin: 0;
      }
      & span{
        line-height: 24px;
      }
    }
    .apartments{
      &:after{
        display: none;
      }
      &:before{
        top: unset;
        bottom: -90%;
        transform: none;
      }
      & .w-1\/5, & .w-4\/5{
        width: 100%;
        & .flex-col{
          flex-wrap: wrap;
          flex-direction: row;
        }
      }
      & .w-2\/3{
        justify-content: space-between;
        width: 100%;
      }
      & .mt-32{
        flex-direction: column;
      }
      & img{
        // transform: scale(1.5);
      }
      & span{
        font-size: 14px;
      }
    }
    .builder{
      margin-bottom: 20vh;
      & .img{
        max-height: 66.66vh;
      }
      &>.content{
        flex-direction: column-reverse;
        &>div{
          width: 100%;
          margin-bottom: 40px;
          &:last-child{
            width: 80%;
            margin-left: 15%;
          }
        }
      }
      & h4{
        font-size: 20px;
      }
      & span{
        font-size: 2rem;
        &.mt-32{
          margin-top: 18px;
        }
      }
    }
    .map{
      padding-bottom: 10vh;
      &>.content{
        height: auto;
        flex-direction: column-reverse;
        
        & div, & a{
          flex-wrap: wrap;
          width: 100%;
          font-size: 2rem;
          &.active{
            margin: 1rem 0;
            padding-right: 1.25rem;
            padding-bottom: 2rem;
            width: auto;
          }
        }
        & span{
          margin-top: 0.5rem;
          font-size: 1rem;
        }
        & img{
          transform: scale(2.5) translateX(17.5%);
          max-height: 100vh;
          max-width: calc(100% + 4rem);
          position: relative;
        }
      }
    }
    .footer{
      &>.content{
        flex-direction: column-reverse;
        & h4{
          font-size: 2rem;
        }
        & a{
          font-size: 1.5rem;
        }
        &>*{
          width: 100%;
        }
      }
    }
    input{
      font-size: 1.5rem;
      &.error{
        border-color: red;
      }
      &::placeholder{
        font-size: 1.25rem !important;
      }
    }
    button{
      font-size: 18px;
      max-width: 100%;
      &:hover:before, &:hover:after{
        transition: 0.3s;
      }
    }
    h1{
      font-weight: bold;
      font-size: 4rem;
    }
    h2{
      font-weight: bold;
      font-size: 2.75rem;
    }
    h3{
      font-weight: bold;
      font-size: 1.5rem;
    }
    h4{
      font-weight: bold;
      font-size: 1.25rem;
    }

  }

  .fade-appart-enter-active, .fade-appart-leave-active {
    transition: opacity .5s;
  }
  .fade-appart-enter, .fade-appart-leave-to {
    opacity: 0;
  }

  @keyframes mover {
    0% {transform: translateX(-0%)}
    10% {transform: translateX(-0%)}
    
    15% {transform: translateX(-100vw)}
    25% {transform: translateX(-100vw)}
    
    30% {transform: translateX(-200vw)}
    40% {transform: translateX(-200vw)}
    
    45% {transform: translateX(-300vw)}
    55% {transform: translateX(-300vw)}
    
    60% {transform: translateX(-400vw)}
    70% {transform: translateX(-400vw)}
    
    75% {transform: translateX(-500vw)}
    85% {transform: translateX(-500vw)}
    
    90% {transform: translateX(-600vw)}
    95% {transform: translateX(-600vw)}
    
    100% {transform: translateX(-700vw)}
  }
</style>
