<script setup>
const isFormValid = ref(false)
const refForm = ref()

const refInputEl = ref()
const isSubmitting = ref(false)
const isConfirmDialogOpen = ref(false)
const accountData = ref({})
const accountDataLocal = ref((accountData))
const isAccountDeactivated = ref(false)
const validateAccountDeactivation = [v => !!v || 'Please confirm account deactivation']

const resetForm = () => {
  accountDataLocal.value = (accountData)
}

const changeAvatar = e => {
  const file = e.target.files[0]
  if (!file) return

  // For preview
  const reader = new FileReader()
  reader.readAsDataURL(file)
  reader.onload = () => {
    accountDataLocal.value.avatarPreview = reader.result // for UI preview
  }

  // Keep the actual File object for uploading
  accountDataLocal.value.avatarFile = file
}


// reset avatar image
const resetAvatar = () => {
  accountDataLocal.value.avatarImg = accountData.avatarImg
}

const fetchAccountData = async () => {
  const { id } = useCookie('userData').value.contact
  const { data, error } = await useApi(`/contact/${id}`)

  if (error.value)
    console.log(error.value)
  else if (data.value)
    console.log(data.value.data)
  accountData.value = data.value.data

}
onMounted(() => {
  fetchAccountData()
})
const onSubmit = async () => {
  const data = accountDataLocal.value;
  isSubmitting.value = true

  try {
    const { valid } = await refForm.value?.validate();

    if (!valid) return;

    // for file upload, use FormData
    const formData = new FormData();
    for (const key in data) {
      // Skip avatarFile (we handle it below)
      if (key === 'avatarFile') continue
      formData.append(key, data[key])
    }

    // Only append avatar file if exists
    if (data.avatarFile) {
      formData.append('avatar', data.avatarFile)
    }
    const res = await $api(`/contact/${data.id}`, {
      method: 'PUT',
      body: formData,
    })
    nextTick(() => {
      refForm.value?.resetValidation()
    })

  } catch (error) {
    console.error(error);
  }
  finally {
    isSubmitting.value = false
  }

}
</script>

<template>
  <VRow>
    <VCol cols="12">
      <VCard>
        <pre>{{ accountDataLocal }}</pre>
        <VCardText class="d-flex">
          <!-- 👉 Avatar -->
          <VAvatar rounded size="100" class="me-6" :image="accountDataLocal.avatarImg" />

          <!-- 👉 Upload Photo -->
          <form class="d-flex flex-column justify-center gap-4">
            <div class="d-flex flex-wrap gap-4">
              <VBtn color="primary" size="small" @click="refInputEl?.click()">
                <VIcon icon="tabler-cloud-upload" class="d-sm-none" />
                <span class="d-none d-sm-block">Upload new photo</span>
              </VBtn>

              <input ref="refInputEl" type="file" name="file" accept=".jpeg,.png,.jpg,GIF" hidden @input="changeAvatar">

              <VBtn type="reset" size="small" color="secondary" variant="tonal" @click="resetAvatar">
                <span class="d-none d-sm-block">Reset</span>
                <VIcon icon="tabler-refresh" class="d-sm-none" />
              </VBtn>
            </div>

            <p class="text-body-1 mb-0">
              Allowed JPG, GIF or PNG. Max size of 800K
            </p>
          </form>
        </VCardText>

        <VCardText class="pt-2">
          <!-- 👉 Form -->
          <VForm class="mt-3" ref="refForm" v-model="isFormValid" @submit.prevent="onSubmit">
            <VRow>
              <!-- 👉 First Name -->
              <VCol md="6" cols="12">
                <AppTextField v-model="accountDataLocal.name" placeholder="John" label="Name"
                  :rules="[requiredValidator]" />
              </VCol>

              <!-- 👉 Email -->
              <VCol cols="12" md="6">
                <AppTextField v-model="accountDataLocal.email" label="E-mail" placeholder="johndoe@gmail.com"
                  type="email" :rules="[requiredValidator]" />
              </VCol>

              <!-- 👉 Phone -->
              <VCol cols="12" md="6">
                <AppTextField v-model="accountDataLocal.phone" label="Phone Number" placeholder="+1 (917) 543-9876" />
              </VCol>

              <!-- 👉 Address -->
              <VCol cols="12" md="6">
                <AppTextField v-model="accountDataLocal.address" label="Address"
                  placeholder="123 Main St, New York, NY 10001" />
              </VCol>

              <!-- 👉 Country -->
              <VCol cols="12" md="6">
                <AppSelect v-model="accountDataLocal.country" label="Country"
                  :items="['USA', 'Canada', 'UK', 'India', 'Australia']" placeholder="Select Country" />
              </VCol>

              <!-- 👉 State -->
              <VCol cols="12" md="6">
                <AppTextField v-model="accountDataLocal.city_id" label="City" placeholder="New York" />
              </VCol>

              <!-- 👉 Language -->
              <VCol cols="12" md="6">
                <AppSelect v-model="accountDataLocal.language" label="Language" placeholder="Select Language"
                  :items="['English', 'Spanish', 'Arabic', 'Hindi', 'Urdu']" />
              </VCol>

              <!-- 👉 Form Actions -->
              <VCol cols="12" class="d-flex flex-wrap gap-4">
                <VBtn type="submit" :disabled="isSubmitting">
                  <VProgressCircular v-if="isSubmitting" indeterminate size="20" width="2" class="me-2" />
                  {{ isSubmitting ? 'Saving...' : 'Save changes' }}
                </VBtn>

                <VBtn color="secondary" variant="tonal" type="reset" @click.prevent="resetForm">
                  Cancel
                </VBtn>
              </VCol>
            </VRow>
          </VForm>
        </VCardText>
      </VCard>
    </VCol>

    <VCol cols="12">
      <!-- 👉 Delete Account -->
      <VCard title="Delete Account">
        <VCardText>
          <!-- 👉 Checkbox and Button  -->
          <div>
            <VCheckbox v-model="isAccountDeactivated" :rules="validateAccountDeactivation"
              label="I confirm my account deactivation" />
          </div>

          <VBtn :disabled="!isAccountDeactivated" color="error" class="mt-6" @click="isConfirmDialogOpen = true">
            Deactivate Account
          </VBtn>
        </VCardText>
      </VCard>
    </VCol>
  </VRow>

  <!-- Confirm Dialog -->
  <ConfirmDialog v-model:is-dialog-visible="isConfirmDialogOpen"
    confirmation-question="Are you sure you want to deactivate your account?" confirm-title="Deactivated!"
    confirm-msg="Your account has been deactivated successfully." cancel-title="Cancelled"
    cancel-msg="Account Deactivation Cancelled!" />
</template>
