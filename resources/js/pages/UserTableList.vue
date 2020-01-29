<template>
  <div class="row">
    <div class="col-12">
      <card :title="title">
        <div slot="raw-content" class="table-responsive">
          <table class="table striped">
            <thead>
            <slot name="columns">
              <th v-for="column in tableColumns" :key="column">
                {{ column }}
              </th>
            </slot>
            </thead>
            <tbody>
              <tr v-for="(item, index) in tableData" :key="item.id + '' + index">
                <td v-text="item.name"></td>
                <td v-text="item.email"></td>
                <td v-text="item.title"></td>
                <td :class="(item.status === 'Active') ? 'text-success' : 'text-danger'" v-text="item.status"></td>
                <td>View</td>
              </tr>
            </tbody>
            <tfoot>
              <div>
                <nav class="left-align">
                  <ul class="pagination">
                    <li
                      class="page-item"
                      :class="{ 'disabled': current_page === 1 }"
                      @click="movePage(Number(current_page) - 1)"
                      v-show="!(current_page === 1)"
                    >
                      <a class="page-link" :class="{ 'color-text': !(current_page === 1) }">{{ '<' }}</a>
                    </li>
                    <template v-for="pageNumber in total">
                      <li style="cursor: pointer" class="page-item" :class="{'active': current_page === pageNumber}" :key="pageNumber" v-if="Math.abs(pageNumber - current_page) < 3 || pageNumber === total || pageNumber === 1">
                        <a
                          class="page-link"
                          v-bind:key="pageNumber"
                          :class="{ 
                            last: (pageNumber === total && Math.abs(pageNumber - current_page) > 3),
                            first: (pageNumber === 1 && Math.abs(pageNumber - current_page) > 3)
                          }"
                          v-text="pageNumber"
                          @click="movePage(pageNumber)"
                        >
                        </a>
                      </li>
                    </template>
                    <li
                      class="page-item"
                      :class="{ 'disabled': current_page === last_page }"
                      @click="movePage(Number(current_page) + 1)"
                      v-show="!(current_page === last_page)"
                    >
                      <a class="page-link" :class="{ 'color-text': !(current_page === last_page) }"> {{ '>' }} </a>
                    </li>
                  </ul>
                </nav>
              </div>
            </tfoot>
          </table>
        </div>
      </card>
    </div>
  </div>
</template>
<script>
  export default {
    data() {
      return {
        tableColumns: ["Name", "Email", "Title", "Status", "Action"],
        title: "User Master List",
        tableData: [],
        current_page: 1,
        total: 0,
        last_page: 1,
        per_page: 3,
      };
    },
    mounted() {
      this.fetchUsers(1, '', '', 1);
    },
    methods: {
      fetchUsers(page, dateFrom, dateTo, status) {
        this.$axios.get('api/users', {
          params: {
            page: page,
            dateFrom: dateFrom,
            dateTo: dateTo,
            per_page: this.per_page,
          }
        }).then((response) => {
          this.tableData = response.data.data.map((item) => {
            return {
              id: item.id,
              name: this.getInformation(item.user_details, 'name'),
              email: item.email,
              title: this.getInformation(item.user_details, 'title'),
              status: (item.status === 1) ? 'Active' : 'Inactive',
            };
          });
          this.current_page = response.data.current_page;
          this.last_page = response.data.last_page;
          this.total = response.data.last_page;
        }).catch((error) => {
          console.warn(error);
        })
      },
      getInformation(data, field) {
        if (data) {
          if (field === 'name') {
            let fname = data && data.first_name || '';
            let mname = data && data.middle_name || '';
            let lname = data && data.last_name || '';

            return `${fname || ''} ${mname || ''} ${lname || ''}`;
          }
          return (data[field] !== null) ? data[field] : '--';
        }
        return '--';
      },
      movePage(page) {
        this.fetchUsers(page, '', '', 1);
      },
    },
  };
</script>
<style lang="scss">
  a.first::after {
    content:'...'
  }

  a.last::before {
    content:'...'
  }

  .color-text {
    color: #007bff !important;
  }
</style>
