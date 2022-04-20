<div class="lb-schedule-wrapper">
    <?php if($schedule): ?>
        <?php $columns = array(1 => true, 2 => true, 6 => true); ?>
        <?php foreach($schedule as $item): ?>
            <div class="lb-schedule-day-wrapper">
                <h3 class="lb-schedule-day"><?php echo date_i18n('l, d F Y', strtotime($item->date)); ?></h3>
                <table class="lb-schedule">
                    <thead class="lb-schedule-table-head">
                    <tr>
                        <th class="lb-schedule-table-head-time"><?php echo get_lightenbody_option('trans_time', 'Time'); ?></th>
                        <th class="lb-schedule-table-head-class"><?php echo get_lightenbody_option('trans_class', 'Class'); ?></th>
                        <?php if(get_lightenbody_option('show_teacher', 1)): ?>
                            <?php $columns[3] = true; ?>
                            <th class="lb-schedule-table-head-member"><?php echo get_lightenbody_option('trans_teacher', 'Teacher'); ?></th>
                        <?php endif; ?>
                        <?php if(get_lightenbody_option('show_level', 1)): ?>
                            <?php $columns[4] = true; ?>
                            <th class="lb-schedule-table-head-level"><?php echo get_lightenbody_option('trans_level', 'Level'); ?></th>
                        <?php endif; ?>
                        <?php if(get_lightenbody_option('show_location', 1)): ?>
                            <?php $columns[5] = true; ?>
                            <th class="lb-schedule-table-head-location"><?php echo get_lightenbody_option('trans_location', 'Location'); ?></th>
                        <?php endif; ?>
                        <th class="lb-schedule-table-head-booking"></th>
                    </tr>
                    </thead>
                    <tbody class="lb-schedule-table-body">
                    <?php if(!isset($item->scheduleEvents)): ?>
                        <tr><td class="lb-schedule-table-body-error-message" colspan="<?php echo count($columns); ?>"><?php echo get_lightenbody_option('trans_no_classes_today', 'No classes today.'); ?></td></tr>
                    <?php else: ;?>
                        <?php foreach($item->scheduleEvents as $scheduleEvent): ?>
                            <?php if(!$scheduleEvent->isHidden): ?>
                                <tr id="<?php echo $scheduleEvent->referenceId; ?>">
                                    <td class="lb-schedule-table-body-time"><?php echo $scheduleEvent->startTime . ' &ndash; ' . $scheduleEvent->endTime; ?></td>
                                    <td class="lb-schedule-table-body-class"><?php echo is_string($scheduleEvent->scheduleMeta->classService->name) ? $scheduleEvent->scheduleMeta->classService->name : $scheduleEvent->scheduleMeta->classService->name->{"$locale"}->value; ?></td>
                                    <?php if(get_lightenbody_option('show_teacher', 1)): ?>
                                        <?php if(get_lightenbody_option('show_teacher_nickname', 0) && $scheduleEvent->member->nickname): ?>
                                            <td class="lb-schedule-table-body-member"><?php echo $scheduleEvent->member->nickname; ?></td>
                                        <?php else: ?>
                                            <td class="lb-schedule-table-body-member"><?php echo $scheduleEvent->member->user->fullName; ?></td>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                    <?php if(get_lightenbody_option('show_level', 1)): ?>
                                        <td class="lb-schedule-table-body-level"><?php echo is_string($scheduleEvent->scheduleMeta->classService->experienceLevel->name) ? $scheduleEvent->scheduleMeta->classService->experienceLevel->name : $scheduleEvent->scheduleMeta->classService->experienceLevel->name->{"$locale"}->value; ?></td>
                                    <?php endif; ?>
                                    <?php if(get_lightenbody_option('show_location', 1)): ?>
                                        <td class="lb-schedule-table-body-location"><?php echo $scheduleEvent->room->location->name; ?></td>
                                    <?php endif; ?>
                                    <?php if($scheduleEvent->hasStarted): ?>
                                        <td class="lb-schedule-table-body-booking-past"><?php echo get_lightenbody_option('trans_completed', 'Completed'); ?></td>
                                    <?php elseif($scheduleEvent->isCancelled): ?>
                                        <td class="lb-schedule-table-body-booking-cancelled"><?php echo get_lightenbody_option('trans_cancelled', 'Cancelled'); ?></td>
                                    <?php elseif(!$scheduleEvent->isAvailableForBookingAhead): ?>
                                        <td class="lb-schedule-table-body-booking-not-available-yet"><?php echo get_lightenbody_option('trans_not_available_yet', 'Not available yet'); ?></td>
                                    <?php else: ?>
                                        <?php $parameters = http_build_query([
                                            'referenceIds'              => [$scheduleEvent->referenceId],
                                            '_locale'                   => $locale,
                                            'lightenbody-api-source'    => $apiSource
                                        ]); ?>
                                        <?php $url = sprintf("$baseUrl/%s/frontoffice,iframe/delegate?%s", $uuid, $parameters); ?>
                                        <td class="lb-schedule-table-body-booking"><a <?php if('popup' == get_lightenbody_option('delegate_booking_to')): ?>class="lb-schedule-body-booking-link"<?php else: ?>target="_blank"<?php endif; ?> href="<?php echo $url; ?>"><?php echo get_lightenbody_option('trans_book_now', 'Book now'); ?></a></td>
                                    <?php endif; ?>
                                </tr>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    <?php endif;?>
                    </tbody>
                </table>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p class="lb-schedule-error-message"><?php echo get_lightenbody_option('trans_no_public_schedule', 'No public schedule.'); ?></p>
    <?php endif;?>
</div>

