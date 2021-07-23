<template>
    <v-footer
   class="bg"
    padless
  >
    <v-row
      justify="center"
      no-gutters
       class="bg"
    >
      <v-btn
        v-for="link in links"
        :key="link"
        color="white"
        text
        rounded
        class="my-2"
      >
        {{ link }}
      </v-btn>
      <v-col
        class=" py-4 text-center white--text"
        cols="12"
      >
        {{ new Date().getFullYear() }} — <strong>Deliveboo</strong>
      </v-col>
    </v-row>
  </v-footer>
</template>

<script>

export default {
   name:'Footer',
    data: () => ({
      links: [
        'Home',
        'Servizi',
        'Contatti',
      ],
    }),
}
</script>

<style scoped lang="scss">
@import '../../sass/vars.scss';

.bg{
    background: $layout-color;
}

</style>