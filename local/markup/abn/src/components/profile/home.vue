<script lang="ts">
import {defineComponent} from 'vue'
import ProfileShortInfo from "@/components/profile/element/profile-short-info.vue";
import DeveloperDashboard from "@/components/profile/element/developer-dashboard.vue";
import PersonalManager from "@/components/profile/element/personal-manager.vue";
import ProfileOrderCostInfo from "@/components/profile/element/profile-order-cost-info.vue";
import ProfileReferral from "@/components/profile/element/profile-referral.vue";
import ProfileLastView from "@/components/profile/element/profile-last-view.vue";
import ShortManagerList from "@/components/profile/element/short-manager-list.vue";
import ShortAgentList from "@/components/profile/element/short-agent-list.vue";
import ShortStudentList from "@/components/profile/element/short-student-list.vue";

export default defineComponent({
  name: "home",
  components: {
    ShortStudentList,
    ShortAgentList,
    ShortManagerList,
    ProfileLastView,
    ProfileReferral: ProfileReferral,
    ProfileOrderCostInfo: ProfileOrderCostInfo,
    PersonalManager: PersonalManager,
    DeveloperDashboard,
    ProfileShortInfo: ProfileShortInfo
  },
  computed: {
    isDeveloper() {
      return false;
    }
  }
})
</script>

<template>

  <div v-if="isDeveloper">
    <DeveloperDashboard/>
  </div>
  <div v-else>
    <ProfileShortInfo/>
    <PersonalManager/>

    <div class="profile-cards">
      <div class="profile-cards-item">
        <ProfileOrderCostInfo/>
      </div>
      <div class="profile-cards-item">
        <ProfileReferral/>
      </div>
      <div class="profile-cards-item">
        <ProfileLastView/>
      </div>
      <div class="profile-cards-item x12">
        <ShortManagerList/>
      </div>
      <div class="profile-cards-item x12">
        <ShortAgentList/>
      </div>
      <div class="profile-cards-item x12">
        <ShortStudentList/>
      </div>
    </div>
  </div>

</template>

<style scoped>

</style>
