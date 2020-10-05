<template>
  <div>
    <div class="container" v-if="loading">loading...</div>

    <div class="container" v-if="!loading">
      <b-card :header="'Welcome, ' + account.name" class="mt-3">
        <b-card-text>
          <div>
            Account: <code>{{ account.user_id }}</code>
          </div>
          <div>
            Balance:
            <code>${{ account.balance }}</code>
          </div>
        </b-card-text>
        <b-button size="sm" variant="success" @click="show = !show"
          >New payment</b-button
        >

        <b-button
          class="float-right"
          variant="danger"
          size="sm"
          nuxt-link
          to="/"
          >Logout</b-button
        >
        <div v-if="submitted"><h6>Transaction successful</h6></div>
      </b-card>

      <b-card class="mt-3" header="New Payment" v-show="show">
        <b-form @submit.prevent="onSubmit">
          <b-form-group id="input-group-1" label="To:" label-for="input-1">
            <b-form-input
              id="input-1"
              size="sm"
              v-model="payment.to"
              type="number"
              required
              placeholder="Destination ID"
            ></b-form-input>
          </b-form-group>

          <b-form-group id="input-group-2" label="Amount:" label-for="input-2">
            <b-input-group prepend="$" size="sm">
              <b-form-input
                id="input-2"
                v-model="payment.amount"
                type="number"
                required
                placeholder="Amount"
              ></b-form-input>
            </b-input-group>
          </b-form-group>

          <b-form-group id="input-group-3" label="Details:" label-for="input-3">
            <b-form-input
              id="input-3"
              size="sm"
              v-model="payment.details"
              required
              placeholder="Payment details"
            ></b-form-input>
          </b-form-group>

          <b-button type="submit" size="sm" variant="primary">Submit</b-button>
        </b-form>
      </b-card>

      <b-card class="mt-3" header="Payment History">
        <b-table striped hover :items="transactions">
          
        </b-table>

      </b-card>
    </div>
  </div>
</template>

<script lang="ts">
import axios from "axios";
import Vue from "vue";

export default {
  data() {
    return {
      show: false,
      payment: {
        details: '',
        amount: null,
        to: null,
      },

      submitted: false,
      account: {
        balance: 0,
        name: '',
        user_id: null,
      },
      transactions: [],

      loading: true,
    };
  },

  mounted() {
    const that = this;

    this.getAccounts();

    this.getTransactions(that);
  },

  methods: {
    async getAccounts() {
      await axios
      .get(`http://localhost:8000/api/accounts/${this.$route.params.id}`)
      .then(response => {
        if (!response.data.length) {
          this.$router.push({ path: 'home' });
          
        } else {
          this.account = response.data[0];

          if (this.account && this.transactions) {
            this.loading = false;
          }
        }
      })
      .catch(e=>{
        alert('Error! Could not retrieve data. ' + e);
      });
    },

    async getTransactions(that) {
      await axios
      .get(
        `http://localhost:8000/api/accounts/${
          that.$route.params.id
        }/transactions`
      )
      .then(function(response) {
        that.transactions = response.data;

        var transactions = [];
        for (let i = 0; i < that.transactions.length; i++) {
          that.transactions[i].amount =

            "$" + that.transactions[i].amount;

          if (that.account.user_id != that.transactions[i].to) {
            that.transactions[i].amount = "-" + that.transactions[i].amount;
          }

          transactions.push(that.transactions[i]);
        }

        that.transactions = transactions;

        if (that.account && that.transactions) {
          that.loading = false;
        }
      })
      .catch(e=>{
        alert('Error! Could not load data. ' + e);
      });
    },

    async postTransaction() {
      await axios.post(
          `http://localhost:8000/api/accounts/${
            this.$route.params.id
          }/transactions`,this.payment)  
          
          .then(function(response){

            console.log(response);
                           
          })
          .catch(e=>{
            alert(e);
          });
    },

    onSubmit() {
      
      var that = this;

      if (that.payment.amount < this.account.balance && this.account.balance > 0 && that.payment.to != this.account.user_id) {
        
        this.postTransaction();
        this.show = false;
        that.submitted = true;
  
        // update items
        setTimeout(() => {
          this.getAccounts();

          this.getTransactions(that);
          that.submitted = false;

          this.payment.details = '';
          this.payment.amount = null;
          this.payment.to = null;

        }, 500);
      } else if (that.payment.amount > this.account.balance){
        alert("Transaction failed: You have insufficient balance");
          this.payment.details = '';
          this.payment.amount = null;
          this.payment.to = null;

      } else if (that.payment.amount == 0){
        alert("Transaction failed: Value must be greater than zero");
      }
    
      else {
        alert("Transaction failed: Try again or contact your branch for details if you need assistance");
      }

    }
  }
};
</script>
