<div class="community-state-box" style="margin-top: 60px;">
    <h5>@lang('État communautaire')</h5>
    <div class="community-item-wraper">
        <div class="community-item">
            <div class="item-status mb-3">
                <span class="count odometer" data-count="{{ @$last_month_posts }}"></span>
                <h6 class="item-status-title">@lang('Sujets ce mois-ci')</h6>
            </div>
            <div class="item-status">
                <span class="count odometer" data-count="{{ @$total_topic }}"></span>
                <h6 class="item-status-title">@lang('Total des sujets')</h6>
            </div>
        </div>
        <div class="community-item">
            <div class="item-status mb-3">
                <span class="count odometer" data-count="{{ @$conversations }}"></span>
                <h6 class="item-status-title">@lang('Conversations')</h6>
            </div>
            <div class="item-status">
                <span class="count odometer" data-count="{{ @$total_replies }}"></span>
                <h6 class="item-status-title">@lang('Total de réponses')</h6>
            </div>
        </div>
    </div>
</div>
