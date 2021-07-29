<template>
  <header>
    <div class="my_container">
      <div class="logo">
        <img src="/img/logow-notext.png" alt="logo">
        <span>
        Deliveboo
        </span>
      </div>
      <div class="actions">
        <div>
          <svg height="24" width="24" viewBox="0 0 24 24" class="ccl-0f24ac4b87ce1f67 ccl-ed34b65f78f16205 ccl-c738ab1fde928049"><path d="M4.88398 7.11612L3.11621 8.88389L12.0001 17.7678L20.884 8.88389L19.1162 7.11612L12.0001 14.2322L4.88398 7.11612Z"></path></svg>
          Collabora con noi
          </div>
        <div>
          <svg height="24" width="24" viewBox="0 0 24 24" class="ccl-0f24ac4b87ce1f67 ccl-ed34b65f78f16205 ccl-c738ab1fde928049"><path d="M3 10L5 8.44444V5H9.42857L12 3L21 10V21H3V10ZM14 19H19V10.9782L12 5.53372L5 10.9782V19H10V14H14V19Z"></path></svg>
          Registrati o accedi</div>
        <div>
          <svg height="24" width="24" viewBox="0 0 24 24" class="ccl-0f24ac4b87ce1f67 ccl-ed34b65f78f16205 ccl-c738ab1fde928049"><path d="M2 13V11H22V13H2ZM2 19V17H22V19H2ZM2 7V5H22V7H2Z"></path></svg>
          Menu
          </div>
      </div>
    </div>
  </header>
</template>

<script>
export default {
   name: 'Header',
}
</script>

<style scoped lang="scss">
@import '../../sass/vars.scss';
@import '../../sass/mixins.scss';

header{
  height: 66px;
  background-color: $d-primary;
  .my_container{
    height: 100%;
    @include flex("space-bet");
    align-items: center;
    .logo{
      @include flex("center");
      span{
        font-weight: bold;
        color: #fff;
        margin-left: 8px;
      }
    }
    .actions{
      @include flex("flex");
      div{
        @include flex("center");
        background-color: #fff;
        margin: 16px 7px;
        border-radius: 4px;
        padding: 8px 16px;
        cursor: pointer;
        svg{
          width: 18px;
          height: 18px;
          margin-right: 8px;
          color: $d-primary;
          fill: currentColor;
        }
      }
    }
  }
}


</style>