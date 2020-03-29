<?php $this->title = "Profile" ?>

<?php /** @var User $user */ ?>

<div class="container mt-5 pt-5">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="row">
                    <div class="col-12">
                        <ul class="nav nav-tabs mb-4" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="basicInfo-tab" data-toggle="tab" href="#basicInfo" role="tab" aria-controls="basicInfo" aria-selected="true">Basic Info</a>
                            </li>
                        </ul>
                        <div class="tab-content ml-1" id="myTabContent">
                            <div class="tab-pane fade show active" id="basicInfo" role="tabpanel" aria-labelledby="basicInfo-tab">
                                <div class="row">
                                    <div class="col-sm-3 col-md-2 col-5">
                                        <label style="font-weight:bold;">Full Name</label>
                                    </div>
                                    <div class="col-md-8 col-6">
                                        <?= $user->getFirstName() . " " . $user->getLastName() ?>
                                    </div>
                                </div>
                                <hr />

                                <div class="row">
                                    <div class="col-sm-3 col-md-2 col-5">
                                        <label style="font-weight:bold;">City</label>
                                    </div>
                                    <div class="col-md-8 col-6">
                                        <?= $user->getCity() ?>
                                    </div>
                                </div>
                                <hr />

                            </div>
                            <div class="tab-pane fade" id="connectedServices" role="tabpanel" aria-labelledby="ConnectedServices-tab">
                                Facebook, Google, Twitter Account that are connected to this account
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>