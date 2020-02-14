<template>
    <div class="row">
        <div class="col-md-12">
            <fg-input type="text"
                label="HMO Name"
                placeholder="Input the name of HMO"
                v-model="hmo">
            </fg-input>
            <fg-input type="text"
                label="Discount"
                placeholder="Input the Discount"
                v-model="discount">
            </fg-input>
            <div class="form-group">
              <label>About HMO</label>
              <textarea
                rows="5"
                class="form-control border-input"
                placeholder="HMO Description"
                v-model="about">
              </textarea>
            </div>
            <button class="btn btn-primary" @click="submitHMO">
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
      hmo: '',
      discount: '',
      about: '',
    };
  },
  methods: {
    submitHMO() {
      this.$axios.post('api/hmos', {
        name: this.hmo,
        discount: this.discount,
      }).then((response) => {
        console.log(response);
        this.hmo = '';
        this.discount = '';
        this.$notify({
            message: 'HMO Successfully Created',
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
