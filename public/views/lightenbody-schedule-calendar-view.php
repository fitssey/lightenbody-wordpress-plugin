<div class="lb-schedule-calendar-wrapper">
    <?php if($schedule): ?>
    <div class="lb-schedule-days-wrapper">
        <!-- SINGLE DAY HEAD -->
        <?php foreach($schedule as $item): ?>
            <div class="lb-schedule-single-day">
                <p class="lb-schedule-day"><?php echo date_i18n('d.m.Y', strtotime($item->date)); ?><br><?php echo date_i18n('l', strtotime($item->date)); ?></p>
            </div>
        <?php endforeach; ?>
        <!-- end of SINGLE DAY HEAD -->
    </div>
    <div class="lb-schedule">
        <?php if($hasMorningSchedule): ?>
            <!-- MORNING -->
            <div class="lb-schedule-morning-wrapper">
                <div class="lb-schedule-day-part-name">
                    <span class="ng-binding"><?php echo get_lightenbody_option('trans_morning', 'Morning'); ?></span>
                </div>
                <?php foreach($schedule as $item): ?>
                    <!-- SINGLE DAY BODY -->
                    <div class="lb-schedule-single-day">
                        <?php if(isset($item->morning)): ?>
                            <?php foreach($item->morning as $scheduleEvent): ?>
                                <?php if(!$scheduleEvent->isHidden): ?>
                                    <!-- SINGLE CLASS -->
                                    <div class="lb-schedule-single-class <?php if($scheduleEvent->color): ?>lb-schedule-single-class-highlighted<?php endif; ?>" id="<?php echo $scheduleEvent->referenceId; ?>" <?php if($scheduleEvent->color): ?>style="border-color: <?php echo $scheduleEvent->color; ?>"<?php endif; ?>>
                                        <div class="lb-schedule-single-class-highlight-background" style="background-color: <?php echo $scheduleEvent->color; ?>"></div>
                                        <div class="lb-schedule-single-class-highlight" style="border-color: <?php echo $scheduleEvent->color; ?>"></div>
                                        <p class="lb-schedule-table-body-time"><?php echo $scheduleEvent->startTime . ' &ndash; ' . $scheduleEvent->endTime; ?></p>
                                        <p class="lb-schedule-table-body-class"><?php echo is_string($scheduleEvent->scheduleMeta->classService->name) ? $scheduleEvent->scheduleMeta->classService->name : $scheduleEvent->scheduleMeta->classService->name->{"$locale"}->value; ?></p>
                                        <?php if(get_lightenbody_option('show_teacher', 1)): ?>
                                            <?php if(get_lightenbody_option('show_teacher_nickname', 0) && $scheduleEvent->member->nickname): ?>
                                                <p class="lb-schedule-table-body-member"><?php echo $scheduleEvent->member->nickname; ?></p>
                                            <?php else: ?>
                                                <p class="lb-schedule-table-body-member"><?php echo $scheduleEvent->member->user->fullName; ?></p>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                        <?php if(get_lightenbody_option('show_level', 1)): ?>
                                            <p class="lb-schedule-table-body-level"><?php echo is_string($scheduleEvent->scheduleMeta->classService->experienceLevel->name) ? $scheduleEvent->scheduleMeta->classService->experienceLevel->name : $scheduleEvent->scheduleMeta->classService->experienceLevel->name->{"$locale"}->value; ?></p>
                                        <?php endif; ?>
                                        <?php if(get_lightenbody_option('show_location', 1)): ?>
                                            <p class="lb-schedule-table-body-location"><?php echo $scheduleEvent->room->location->name; ?></p>
                                        <?php endif; ?>
                                        <?php if($scheduleEvent->hasStarted): ?>
                                            <p class="lb-schedule-table-body-booking-past"><?php echo get_lightenbody_option('trans_completed', 'Completed'); ?></p>
                                        <?php elseif($scheduleEvent->isCancelled): ?>
                                            <p class="lb-schedule-table-body-booking-cancelled"><?php echo get_lightenbody_option('trans_cancelled', 'Cancelled'); ?></p>
                                        <?php elseif(!$scheduleEvent->isAvailableForBookingAhead): ?>
                                            <p class="lb-schedule-table-body-booking-not-available-yet"><?php echo get_lightenbody_option('trans_not_available_yet', 'Not available yet'); ?></p>
                                        <?php else: ?>
                                            <?php $parameters = http_build_query([
                                                'referenceIds'              => [$scheduleEvent->referenceId],
                                                '_locale'                   => $locale,
                                                'lightenbody-api-source'    => $apiSource
                                            ]); ?>
                                            <?php $url = sprintf("$baseUrl/%s/frontoffice,iframe/delegate?%s", $uuid, $parameters); ?>
                                            <p class="lb-schedule-table-body-booking"><a <?php if('popup' == get_lightenbody_option('delegate_booking_to')): ?>class="lb-schedule-body-booking-button lb-schedule-body-booking-link"<?php else: ?>class="lb-schedule-body-booking-button" target="_blank"<?php endif; ?> <?php if($scheduleEvent->color): ?>style="background-color: <?php echo $scheduleEvent->color; ?>; border-color: <?php echo $scheduleEvent->color; ?>"<?php endif; ?> href="<?php echo $url; ?>"><?php echo get_lightenbody_option('trans_book_now', 'Book now'); ?></a></p>
                                        <?php endif; ?>
                                    </div>
                                    <!-- end of SINGLE CLASS -->
                                <?php endif; ?>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                    <!-- end of SINGLE DAY BODY -->
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
        <!-- end of MORNING -->
        <?php if($hasAfternoonSchedule): ?>
            <!-- AFTERNOON -->
            <div class="lb-schedule-afternoon-wrapper">
                <div class="lb-schedule-day-part-name">
                    <span class="ng-binding"><?php echo get_lightenbody_option('trans_afternoon', 'Afternoon'); ?></span>
                </div>
                <?php foreach($schedule as $item): ?>
                    <!-- SINGLE DAY BODY -->
                    <div class="lb-schedule-single-day">
                        <?php if(isset($item->afternoon)): ?>
                            <?php foreach($item->afternoon as $scheduleEvent): ?>
                                <?php if(!$scheduleEvent->isHidden): ?>
                                    <!-- SINGLE CLASS -->
                                    <div class="lb-schedule-single-class <?php if($scheduleEvent->color): ?>lb-schedule-single-class-highlighted<?php endif; ?>" id="<?php echo $scheduleEvent->referenceId; ?>" <?php if($scheduleEvent->color): ?>style="border-color: <?php echo $scheduleEvent->color; ?>"<?php endif; ?>>
                                        <div class="lb-schedule-single-class-highlight-background" style="background-color: <?php echo $scheduleEvent->color; ?>"></div>
                                        <div class="lb-schedule-single-class-highlight" style="border-color: <?php echo $scheduleEvent->color; ?>"></div>
                                        <p class="lb-schedule-table-body-time"><?php echo $scheduleEvent->startTime . ' &ndash; ' . $scheduleEvent->endTime; ?></p>
                                        <p class="lb-schedule-table-body-class"><?php echo is_string($scheduleEvent->scheduleMeta->classService->name) ? $scheduleEvent->scheduleMeta->classService->name : $scheduleEvent->scheduleMeta->classService->name->{"$locale"}->value; ?></p>
                                        <?php if(get_lightenbody_option('show_teacher', 1)): ?>
                                            <?php if(get_lightenbody_option('show_teacher_nickname', 0) && $scheduleEvent->member->nickname): ?>
                                                <p class="lb-schedule-table-body-member"><?php echo $scheduleEvent->member->nickname; ?></p>
                                            <?php else: ?>
                                                <p class="lb-schedule-table-body-member"><?php echo $scheduleEvent->member->user->fullName; ?></p>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                        <?php if(get_lightenbody_option('show_level', 1)): ?>
                                            <p class="lb-schedule-table-body-level"><?php echo is_string($scheduleEvent->scheduleMeta->classService->experienceLevel->name) ? $scheduleEvent->scheduleMeta->classService->experienceLevel->name : $scheduleEvent->scheduleMeta->classService->experienceLevel->name->{"$locale"}->value; ?></p>
                                        <?php endif; ?>
                                        <?php if(get_lightenbody_option('show_location', 1)): ?>
                                            <p class="lb-schedule-table-body-location"><?php echo $scheduleEvent->room->location->name; ?></p>
                                        <?php endif; ?>
                                        <?php if($scheduleEvent->hasStarted): ?>
                                            <p class="lb-schedule-table-body-booking-past"><?php echo get_lightenbody_option('trans_completed', 'Completed'); ?></p>
                                        <?php elseif($scheduleEvent->isCancelled): ?>
                                            <p class="lb-schedule-table-body-booking-cancelled"><?php echo get_lightenbody_option('trans_cancelled', 'Cancelled'); ?></p>
                                        <?php elseif(!$scheduleEvent->isAvailableForBookingAhead): ?>
                                            <p class="lb-schedule-table-body-booking-not-available-yet"><?php echo get_lightenbody_option('trans_not_available_yet', 'Not available yet'); ?></p>
                                        <?php else: ?>
                                            <?php $parameters = http_build_query([
                                                'referenceIds'              => [$scheduleEvent->referenceId],
                                                '_locale'                   => $locale,
                                                'lightenbody-api-source'    => $apiSource
                                            ]); ?>
                                            <?php $url = sprintf("$baseUrl/%s/frontoffice,iframe/delegate?%s", $uuid, $parameters); ?>
                                            <p class="lb-schedule-table-body-booking"><a <?php if('popup' == get_lightenbody_option('delegate_booking_to')): ?>class="lb-schedule-body-booking-button lb-schedule-body-booking-link"<?php else: ?>class="lb-schedule-body-booking-button" target="_blank"<?php endif; ?> <?php if($scheduleEvent->color): ?>style="background-color: <?php echo $scheduleEvent->color; ?>; border-color: <?php echo $scheduleEvent->color; ?>"<?php endif; ?> href="<?php echo $url; ?>"><?php echo get_lightenbody_option('trans_book_now', 'Book now'); ?></a></p>
                                        <?php endif; ?>
                                    </div>
                                    <!-- end of SINGLE CLASS -->
                                <?php endif; ?>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                    <!-- end of SINGLE DAY BODY -->
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
        <!-- end of AFTERNOON -->
        <?php if($hasEveningSchedule): ?>
            <!-- EVENING -->
            <div class="lb-schedule-evening-wrapper">
                <div class="lb-schedule-day-part-name">
                    <span class="ng-binding"><?php echo get_lightenbody_option('trans_evening', 'Evening'); ?></span>
                </div>
                <?php foreach($schedule as $item): ?>
                    <!-- SINGLE DAY BODY -->
                    <div class="lb-schedule-single-day">
                        <?php if(isset($item->evening)): ?>
                            <?php foreach($item->evening as $scheduleEvent): ?>
                                <?php if(!$scheduleEvent->isHidden): ?>
                                    <!-- SINGLE CLASS -->
                                    <div class="lb-schedule-single-class <?php if($scheduleEvent->color): ?>lb-schedule-single-class-highlighted<?php endif; ?>" id="<?php echo $scheduleEvent->referenceId; ?>" <?php if($scheduleEvent->color): ?>style="border-color: <?php echo $scheduleEvent->color; ?>"<?php endif; ?>>
                                        <div class="lb-schedule-single-class-highlight-background" style="background-color: <?php echo $scheduleEvent->color; ?>"></div>
                                        <div class="lb-schedule-single-class-highlight" style="border-color: <?php echo $scheduleEvent->color; ?>"></div>
                                        <p class="lb-schedule-table-body-time"><?php echo $scheduleEvent->startTime . ' &ndash; ' . $scheduleEvent->endTime; ?></p>
                                        <p class="lb-schedule-table-body-class"><?php echo is_string($scheduleEvent->scheduleMeta->classService->name) ? $scheduleEvent->scheduleMeta->classService->name : $scheduleEvent->scheduleMeta->classService->name->{"$locale"}->value; ?></p>
                                        <?php if(get_lightenbody_option('show_teacher', 1)): ?>
                                            <?php if(get_lightenbody_option('show_teacher_nickname', 0) && $scheduleEvent->member->nickname): ?>
                                                <p class="lb-schedule-table-body-member"><?php echo $scheduleEvent->member->nickname; ?></p>
                                            <?php else: ?>
                                                <p class="lb-schedule-table-body-member"><?php echo $scheduleEvent->member->user->fullName; ?></p>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                        <?php if(get_lightenbody_option('show_level', 1)): ?>
                                            <p class="lb-schedule-table-body-level"><?php echo is_string($scheduleEvent->scheduleMeta->classService->experienceLevel->name) ? $scheduleEvent->scheduleMeta->classService->experienceLevel->name : $scheduleEvent->scheduleMeta->classService->experienceLevel->name->{"$locale"}->value; ?></p>
                                        <?php endif; ?>
                                        <?php if(get_lightenbody_option('show_location', 1)): ?>
                                            <p class="lb-schedule-table-body-location"><?php echo $scheduleEvent->room->location->name; ?></p>
                                        <?php endif; ?>
                                        <?php if($scheduleEvent->hasStarted): ?>
                                            <p class="lb-schedule-table-body-booking-past"><?php echo get_lightenbody_option('trans_completed', 'Completed'); ?></p>
                                        <?php elseif($scheduleEvent->isCancelled): ?>
                                            <p class="lb-schedule-table-body-booking-cancelled"><?php echo get_lightenbody_option('trans_cancelled', 'Cancelled'); ?></p>
                                        <?php elseif(!$scheduleEvent->isAvailableForBookingAhead): ?>
                                            <p class="lb-schedule-table-body-booking-not-available-yet"><?php echo get_lightenbody_option('trans_not_available_yet', 'Not available yet'); ?></p>
                                        <?php else: ?>
                                            <?php $parameters = http_build_query([
                                                'referenceIds'              => [$scheduleEvent->referenceId],
                                                '_locale'                   => $locale,
                                                'lightenbody-api-source'    => $apiSource
                                            ]); ?>
                                            <?php $url = sprintf("$baseUrl/%s/frontoffice,iframe/delegate?%s", $uuid, $parameters); ?>
                                            <p class="lb-schedule-table-body-booking"><a <?php if('popup' == get_lightenbody_option('delegate_booking_to')): ?>class="lb-schedule-body-booking-button lb-schedule-body-booking-link"<?php else: ?>class="lb-schedule-body-booking-button" target="_blank"<?php endif; ?> <?php if($scheduleEvent->color): ?>style="background-color: <?php echo $scheduleEvent->color; ?>; border-color: <?php echo $scheduleEvent->color; ?>"<?php endif; ?> href="<?php echo $url; ?>"><?php echo get_lightenbody_option('trans_book_now', 'Book now'); ?></a></p>
                                        <?php endif; ?>
                                    </div>
                                    <!-- end of SINGLE CLASS -->
                                <?php endif; ?>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                    <!-- end of SINGLE DAY BODY -->
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
        <!-- end of EVENING -->
    </div>
    <div class="clearfix"></div>
</div>
<?php else: ?>
    <p class="lb-schedule-error-message"><?php echo $options['no_public_schedule_translation']; ?></p>
<?php endif;?>
</div>

