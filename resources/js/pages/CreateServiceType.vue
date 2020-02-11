<template>
    <div class="row">
        <div class="col-md-12">
            <fg-input type="text"
                label="Service Type Name"
                placeholder="Input the name of Service Type"
                v-model="service_type">
            </fg-input>
            <button class="btn btn-primary" @click="submitServiceType">
              Submit
            </button>
        </div>
    </div>
</template>
<script>
import NotificationTemplate from '../pages/Notifications/NotificationTemplate';
import EditProfileForm from "./UserProfile/EditProfileForm.vue";
import UserCard from "./UserProfile/UserCard.vue";
import MembersCard from "./UserProfile/MembersCard.vue";
export default {
  components: {
    EditProfileForm,
    UserCard,
    MembersCard,
    NotificationTemplate
  },
  data() {
    return {
      service_type: '',
    };
  },
  methods: {
    submitServiceType() {
      this.$axios.post('api/service-types', {
        name: this.service_type,
      }).then((response) => {
        console.log(response);
        this.hmo = '';
        this.discount = '';
        this.$notify({
            message: 'Service Type Successfully Created',
            component: NotificationTemplate,
            icon: "ti-close",
            horizontalAlign: 'right',
            verticalAlign: 'top',
            type: 'success'
        });
      }).catch((error) => {
        console.log(error);
        this.$notify({
            message: 'Something went wrong',
            component: NotificationTemplate,
            icon: "ti-close",
            horizontalAlign: 'right',
            verticalAlign: 'top',
            type: 'danger'
        });
      })
    },
  },
};
</script>
<style>
</style>
