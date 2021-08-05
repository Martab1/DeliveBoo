<template>
    <footer>
      <div class="my_container">

        <div class="top">

          <!-- Scopri Deliveroo -->
          <div class="f-info">
            <h3>Scopri Deliveboo</h3>
            <ul class="my-ul">
              <li v-for="(link, index) in scopri" :key="'scopri'+index">
                <a href="#">{{link}}</a>
              </li>
            </ul>
          </div>

          <!-- Note legali -->
          <div class="f-info">
            <h3>Note legali</h3>
            <ul class="my-ul">
              <li v-for="(link, index) in note" :key="'note'+index">
                <a href="#">{{link}}</a>
              </li>
            </ul>
          </div>

          <!-- Aiuto -->
          <div class="f-info">
            <h3>Aiuto</h3>
            <ul class="my-ul">
              <li v-for="(link, index) in aiuto" :key="'aiuto'+index">
                <a href="#">{{link}}</a>
              </li>
            </ul>
          </div>

          <!-- app link -->
          <div class="f-info">
            <h3>Porta Deliveboo con te</h3>
            <a href="#">
              <img src="https://www.tbus.it/img/appstore-ita.png" alt="">
            </a>
            <a href="#">
              <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/5f/Google_Play_Store_badge_IT.svg/1024px-Google_Play_Store_badge_IT.svg.png" alt="">
            </a>
          </div>
        </div>

        <div class="bot">
          <div class="social">
            <ul class="my-ul">
              <li>
                <a href="#">
                  <i class="fab fa-facebook"></i>
                </a>
              </li>
              <li>
                <a href="#">
                  <i class="fab fa-twitter"></i>
                </a>
              </li>
              <li>
                <a href="#">
                 <i class="fab fa-instagram"></i>
                </a>
              </li>
            </ul>
          </div>

          <span>© 2021 Deliveboo</span>
        </div>

      </div>
        
    </footer>
</template>

<script>

export default {
   name:'Footer',
    data: () => ({
      scopri : [
        'Investitori',
        'Chi siamo',
        'Ristoranti',
        'Altro',
        'Pressroom',
        'Il nostro blog',
        'Programmazione',
        'Design',
        'Lavora con noi',
        'Diventa nostro partner',
      ],
      note: [
        'Termini & Condizioni',
        'Informativa sulla privacy',
        'Cookies',
      ],
      aiuto: [
        'Contatti',
        'FAQ',
        'Tipi di cucina',
        'Mappa del sito'
      ],
    }),
}
</script>

<style scoped lang="scss">
@import '../../sass/vars.scss';

.my-ul{
  padding:0;
  list-style: none;
}

footer{
  background-color: $d-black;
  padding: 20px;
  .top{
    color: white;
    display: flex;
    justify-content: space-between;
    overflow: auto;
    .f-info{
      padding: 30px 20px;
      background-color: rgba(255,255,255, 0.1);
      width: calc(100% / 4 - 15px);
      border-radius: 3px;
      margin: 10px;
      min-width: 224px;
      &:first-child{
        margin-left: 0px;
      }
      &:last-child{
        margin-right: 0px;
      }

      img{
        max-width: 50%;
        margin-bottom: 5px;
      }

      h3{
        margin-bottom: 10px;
      }

      ul.my-ul{
        li{
          a{
            display: block;
            color: white;
            text-decoration: none;
            font-size: 14px;
            margin-bottom: 3px;

            &:hover{
              color: $d-a;
            }
          }
        }
      }
    }
  }

  .bot{
    display: flex;
    justify-content: space-between;
    padding: 20px 0 0;

    .social{
      ul{
        display: flex;
        a{
          color: white;
          margin-right: 20px;
          font-size: 20px;
          &:hover .fa-facebook{
            color: #5e81cc;
          }
          &:hover .fa-twitter{
            color: #00acee;
          }
          &:hover .fa-instagram{
            color: #d428bd;
          }
        }
      }

    }
    span{
      color: rgba(255,255,255, 0.2);
      font-size: 14px;
    }
  }
}

</style>