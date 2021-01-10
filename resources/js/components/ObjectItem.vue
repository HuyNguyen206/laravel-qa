<template>
    <li class="list-group-item">
        <div class="row align-items-center">
            <div class="col-2">
                <span class="post-badge" :class="{ accepted: object.accepted }">{{ object.type }}</span>
                <span class="votes-count" :class="{ accepted: object.accepted }">{{ object.votes_count }}</span>
            </div>
            <div class="col-md-8 text-left">
                {{ object.title }}
            </div>
            <div class="col-md-2">
               {{ object.created_at }}
            </div>
        </div>
    </li>
</template>

<script>
    export default {
        name: "ObjectItem",
        props:['object'],
    }
</script>

<style lang="scss" scoped>
    $color-green:rgba(95, 187, 126);
    .post-badge
    {
        text-align: center;
        display: inline-block;
        padding: 5px;
        border-radius: 50%;
        width: 35px;
        height: 35px;
    &.accepted
     {
         border: 1px solid $color-green;
         color:  $color-green;
     }
    }

    .votes-count
    {
        text-align: center;
        display: inline-block;
        padding: 5px 20px;
        border-radius: 5px;
        margin-left: 5px;
    &.accepted
     {
         color: white;
         background:  $color-green;
     }
    }
</style>
