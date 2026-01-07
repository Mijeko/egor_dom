<script lang="ts">
import {defineComponent} from 'vue'
import Homepage from '@/layouts/homepage.vue';
import ContactsBlock from "@/components/homepage/contacts-block.vue";
import DeveloperIcons from "@/components/homepage/developer-icons.vue";
import SecurityBlock from "@/components/homepage/security-block.vue";
import HowItWork from "@/components/homepage/how-it-work.vue";
import Chota from "@/components/chota.vue";
import FirstScreen from "@/components/homepage/first-screen.vue";
import type BxUserDto from "@/dto/bitrix/BxUserDto.ts";
import type {ReviewDto} from "@/dto/entity/ReviewDto.ts";

export default defineComponent({
  name: "index",
  components: {FirstScreen, Chota, HowItWork, SecurityBlock, DeveloperIcons, ContactsBlock},
  layout: [Homepage],
  props: {
    user: {
      type: Object as PropType<BxUserDto>,
      default: () => {
        return {};
      }
    }
  },
  data: () => {
    return {
      reviews: [
        {
          id: Math.random(),
          author: 'Сергей В.',
          date: '21.02.2025 г.',
          text: '<p>Мы объединяем на одной платформе всех участников рынка — от застройщиков до инвесторов. Даём каждому возможность зарабатывать, инвестировать и покупать недвижимость легко и безопасно.Все сделки проходят прозрачно, быстро и с юридическим сопровождением.</p>'
        },
        {
          id: Math.random(),
          author: 'Сергей В.',
          date: '21.02.2025 г.',
          text: '<p>Мы объединяем на одной платформе всех участников рынка — от застройщиков до инвесторов. Даём каждому возможность зарабатывать, инвестировать и покупать недвижимость легко и безопасно.Все сделки проходят прозрачно, быстро и с юридическим сопровождением.</p>'
        },
        {
          id: Math.random(),
          author: 'Сергей В.',
          date: '21.02.2025 г.',
          text: '<p>Мы объединяем на одной платформе всех участников рынка — от застройщиков до инвесторов. Даём каждому возможность зарабатывать, инвестировать и покупать недвижимость легко и безопасно.Все сделки проходят прозрачно, быстро и с юридическим сопровождением.</p>'
        },
        {
          id: Math.random(),
          author: 'Сергей В.',
          date: '21.02.2025 г.',
          text: '<p>Мы объединяем на одной платформе всех участников рынка — от застройщиков до инвесторов. Даём каждому возможность зарабатывать, инвестировать и покупать недвижимость легко и безопасно.Все сделки проходят прозрачно, быстро и с юридическим сопровождением.</p>'
        },
        {
          id: Math.random(),
          author: 'Сергей В.',
          date: '21.02.2025 г.',
          text: '<p>Мы объединяем на одной платформе всех участников рынка — от застройщиков до инвесторов. Даём каждому возможность зарабатывать, инвестировать и покупать недвижимость легко и безопасно.Все сделки проходят прозрачно, быстро и с юридическим сопровождением.</p>'
        },
      ] as ReviewDto[],
    };
  }
})
</script>

<template>

  <FirstScreen
    :user
  />

  <SecurityBlock/>
  <HowItWork/>
  <DeveloperIcons/>
  <ReviewsBlock
    :reviews
  />
  <Chota/>
  <ContactsBlock/>

</template>

<style lang="scss">

</style>
