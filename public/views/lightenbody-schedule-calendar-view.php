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
                        <?php if(isset($item->scheduleEvents->morning)): ?>
                            <?php foreach($item->scheduleEvents->morning as $scheduleEvent): ?>
                                <?php if(!$scheduleEvent->isHidden): ?>
                                    <!-- SINGLE CLASS -->
                                    <div class="lb-schedule-single-class" id="<?php echo $scheduleEvent->referenceId; ?>">
                                        <p class="lb-schedule-table-body-time"><?php echo $scheduleEvent->startTime . ' &ndash; ' . $scheduleEvent->endTime; ?></p>
                                        <p class="lb-schedule-table-body-class"><?php echo $scheduleEvent->scheduleMeta->classService->name->{"$locale"}->value; ?></p>
                                        <?php if(get_lightenbody_option('show_teacher', 1)): ?>
                                            <p class="lb-schedule-table-body-member"><?php echo $scheduleEvent->member->user->fullName; ?></p>
                                        <?php endif; ?>
                                        <?php if(get_lightenbody_option('show_level', 1)): ?>
                                            <p class="lb-schedule-table-body-level"><?php echo $scheduleEvent->scheduleMeta->classService->experienceLevel->name->{"$locale"}->value; ?></p>
                                        <?php endif; ?>
                                        <?php if(get_lightenbody_option('show_location', 1)): ?>
                                            <p class="lb-schedule-table-body-location"><?php echo $scheduleEvent->room->location->name->{"$locale"}->value; ?></p>
                                        <?php endif; ?>
                                        <?php if($scheduleEvent->hasStarted): ?>
                                            <p class="lb-schedule-table-body-booking-past"><?php echo get_lightenbody_option('trans_class_completed', 'Completed'); ?></p>
                                        <?php elseif($scheduleEvent->isCancelled): ?>
                                            <p class="lb-schedule-table-body-booking-cancelled"><?php echo get_lightenbody_option('trans_class_cancelled', 'Cancelled'); ?></p>
                                        <?php else: ?>
                                            <?php $parameters = http_build_query([
                                                'referenceIds'              => [$scheduleEvent->referenceId],
                                                '_locale'                   => $locale,
                                                'lightenbody-api-source'    => $apiSource
                                            ]); ?>
                                            <?php $url = sprintf("$baseUrl/%s/frontoffice,iframe/delegate?%s", $uuid, $parameters); ?>
                                            <p class="lb-schedule-table-body-booking"><a class="lb-schedule-body-booking-link" href="<?php echo $url; ?>"><?php echo get_lightenbody_option('trans_book_now', 'Book now'); ?></a></p>
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
                        <?php if(isset($item->scheduleEvents->afternoon)): ?>
                            <?php foreach($item->scheduleEvents->afternoon as $scheduleEvent): ?>
                                <?php if(!$scheduleEvent->isHidden): ?>
                                    <!-- SINGLE CLASS -->
                                    <div class="lb-schedule-single-class" id="<?php echo $scheduleEvent->referenceId; ?>">
                                        <p class="lb-schedule-table-body-time"><?php echo $scheduleEvent->startTime . ' &ndash; ' . $scheduleEvent->endTime; ?></p>
                                        <p class="lb-schedule-table-body-class"><?php echo $scheduleEvent->scheduleMeta->classService->name->{"$locale"}->value; ?></p>
                                        <?php if(get_lightenbody_option('show_teacher', 1)): ?>
                                            <p class="lb-schedule-table-body-member"><?php echo $scheduleEvent->member->user->fullName; ?></p>
                                        <?php endif; ?>
                                        <?php if(get_lightenbody_option('show_level', 1)): ?>
                                            <p class="lb-schedule-table-body-level"><?php echo $scheduleEvent->scheduleMeta->classService->experienceLevel->name->{"$locale"}->value; ?></p>
                                        <?php endif; ?>
                                        <?php if(get_lightenbody_option('show_location', 1)): ?>
                                            <p class="lb-schedule-table-body-location"><?php echo $scheduleEvent->room->location->name->{"$locale"}->value; ?></p>
                                        <?php endif; ?>
                                        <?php if($scheduleEvent->hasStarted): ?>
                                            <p class="lb-schedule-table-body-booking-past"><?php echo get_lightenbody_option('trans_class_completed', 'Completed'); ?></p>
                                        <?php elseif($scheduleEvent->isCancelled): ?>
                                            <p class="lb-schedule-table-body-booking-cancelled"><?php echo get_lightenbody_option('trans_class_cancelled', 'Cancelled'); ?></p>
                                        <?php else: ?>
                                            <?php $parameters = http_build_query([
                                                'referenceIds'              => [$scheduleEvent->referenceId],
                                                '_locale'                   => $locale,
                                                'lightenbody-api-source'    => $apiSource
                                            ]); ?>
                                            <?php $url = sprintf("$baseUrl/%s/frontoffice,iframe/delegate?%s", $uuid, $parameters); ?>
                                            <p class="lb-schedule-table-body-booking"><a class="lb-schedule-body-booking-link" href="<?php echo $url; ?>"><?php echo get_lightenbody_option('trans_book_now', 'Book now'); ?></a></p>
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
                        <?php if(isset($item->scheduleEvents->evening)): ?>
                            <?php foreach($item->scheduleEvents->evening as $scheduleEvent): ?>
                                <?php if(!$scheduleEvent->isHidden): ?>
                                    <!-- SINGLE CLASS -->
                                    <div class="lb-schedule-single-class" id="<?php echo $scheduleEvent->referenceId; ?>">
                                        <p class="lb-schedule-table-body-time"><?php echo $scheduleEvent->startTime . ' &ndash; ' . $scheduleEvent->endTime; ?></p>
                                        <p class="lb-schedule-table-body-class"><?php echo $scheduleEvent->scheduleMeta->classService->name->{"$locale"}->value; ?></p>
                                        <?php if(get_lightenbody_option('show_teacher', 1)): ?>
                                            <p class="lb-schedule-table-body-member"><?php echo $scheduleEvent->member->user->fullName; ?></p>
                                        <?php endif; ?>
                                        <?php if(get_lightenbody_option('show_level', 1)): ?>
                                            <p class="lb-schedule-table-body-level"><?php echo $scheduleEvent->scheduleMeta->classService->experienceLevel->name->{"$locale"}->value; ?></p>
                                        <?php endif; ?>
                                        <?php if(get_lightenbody_option('show_location', 1)): ?>
                                            <p class="lb-schedule-table-body-location"><?php echo $scheduleEvent->room->location->name->{"$locale"}->value; ?></p>
                                        <?php endif; ?>
                                        <?php if($scheduleEvent->hasStarted): ?>
                                            <p class="lb-schedule-table-body-booking-past"><?php echo get_lightenbody_option('trans_class_completed', 'Completed'); ?></p>
                                        <?php elseif($scheduleEvent->isCancelled): ?>
                                            <p class="lb-schedule-table-body-booking-cancelled"><?php echo get_lightenbody_option('trans_class_cancelled', 'Cancelled'); ?></p>
                                        <?php else: ?>
                                            <?php $parameters = http_build_query([
                                                'referenceIds'              => [$scheduleEvent->referenceId],
                                                '_locale'                   => $locale,
                                                'lightenbody-api-source'    => $apiSource
                                            ]); ?>
                                            <?php $url = sprintf("$baseUrl/%s/frontoffice,iframe/delegate?%s", $uuid, $parameters); ?>
                                            <p class="lb-schedule-table-body-booking"><a class="lb-schedule-body-booking-link" href="<?php echo $url; ?>"><?php echo get_lightenbody_option('trans_book_now', 'Book now'); ?></a></p>
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

