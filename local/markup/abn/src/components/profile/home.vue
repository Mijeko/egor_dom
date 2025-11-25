<script lang="ts">
import {defineComponent} from 'vue'
import ProfileShortInfo from "@/components/profile/element/profile-short-info.vue";
import DeveloperDashboard from "@/components/profile/element/developer-dashboard.vue";
import PersonalManager from "@/components/profile/element/personal-manager.vue";
import ProfileOrderCostInfo from "@/components/profile/element/profile-order-cost-info.vue";
import ProfileReferral from "@/components/profile/element/profile-referral.vue";

export default defineComponent({
  name: "home",
  components: {
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
        <?php
		$APPLICATION->IncludeComponent(
        'craft:object.last.view',
        '.default',
        [
        'USER_ID' => CraftUser::load()->getId(),
        ],
        false,
        ['HIDE_ICONS' => 'Y']
        );
        ?>
      </div>
      <div class="profile-cards-item x12">
        <?php
		$APPLICATION->IncludeComponent(
        'craft:manager.list',
        '.default',
        [],
        false,
        ['HIDE_ICONS' => 'Y']
        );
        ?>
      </div>
      <div class="profile-cards-item x12">
        <?php
		$APPLICATION->IncludeComponent(
        'craft:agent.list',
        '.default',
        [],
        false,
        ['HIDE_ICONS' => 'Y']
        );
        ?>
      </div>
      <div class="profile-cards-item x12">
        <?php
		$APPLICATION->IncludeComponent(
        'craft:student.list',
        '.default',
        [],
        false,
        ['HIDE_ICONS' => 'Y']
        );
        ?>
      </div>
    </div>
  </div>

</template>

<style scoped>

</style>
