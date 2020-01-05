<?php
namespace App\Helpers;

use Iluminate\Support\Facade\DB;

Class CustomTime{

    public static function longTimeFilter($date){
        if($date == null){
            return 'Sin fecha';
        }

        $date_start = $date;
        $since_start = $date_start->diff(new \DateTime(date("Y-m-d") .' '. date("H:i:s")));

        if ($since_start->y == 0) {
            if ($since_start->m == 0) {
                if ($since_start->d == 0) {
                    if ($since_start->h == 0) {
                        if ($since_start->i == 0) {
                            if ($since_start->s == 0) {
                                $result = $since_start->s . ' segundos';
                            } else {
                                if ($since_start->s == 1) {
                                    $result = $since_start->s . ' segundo';
                                } else {
                                    $result = $since_start->s . ' segundos';
                                }
                            }
                        } else {
                            if ($since_start->i == 1) {
                                $result = $since_start->i . ' S';
                            } else {
                                $result = $since_start->i . ' minutos';
                            }
                        }
                    } else {
                        if ($since_start->h == 1) {
                            $result = $since_start->h . ' hora';
                        } else {
                            $result = $since_start->h . ' horas';
                        }
                    }
                } else {
                    if ($since_start->d == 1) {
                        $result = $since_start->d . ' día';
                    } else {
                        $result = $since_start->d . ' días';
                    }
                }
            } else {
                if ($since_start->m == 1) {
                    $result = $since_start->m . ' mes';
                } else {
                    $result = $since_start->m . ' meses';
                }
            }
        } else {
            if ($since_start->y == 1) {
                $result = $since_start->y . ' año';
            } else {
                $result = $since_start->y . ' años';
            }
        }
 
        return 'hace '.$result;
    }

    public static function longTimeFilterShort($date){
        if($date == null){
            return 'Sin fecha';
        }

        $date_start = $date;
        $since_start = $date_start->diff(new \DateTime(date("Y-m-d") .' '. date("H:i:s")));

        if ($since_start->y == 0) {
            if ($since_start->m == 0) {
                if ($since_start->d == 0) {
                    if ($since_start->h == 0) {
                        if ($since_start->i == 0) {
                            if ($since_start->s == 0) {
                                $result = $since_start->s . 'S';
                            } else {
                                if ($since_start->s == 1) {
                                    $result = $since_start->s . 'S';
                                } else {
                                    $result = $since_start->s . 'S';
                                }
                            }
                        } else {
                            if ($since_start->i == 1) {
                                $result = $since_start->i . 'min';
                            } else {
                                $result = $since_start->i . 'min';
                            }
                        }
                    } else {
                        if ($since_start->h == 1) {
                            $result = $since_start->h . 'H';
                        } else {
                            $result = $since_start->h . 'H';
                        }
                    }
                } else {
                    if ($since_start->d == 1) {
                        $result = $since_start->d . 'D';
                    } else {
                        $result = $since_start->d . 'D';
                    }
                }
            } else {
                if ($since_start->m == 1) {
                    $result = $since_start->m . 'M';
                } else {
                    $result = $since_start->m . 'M';
                }
            }
        } else {
            if ($since_start->y == 1) {
                $result = $since_start->y . 'A';
            } else {
                $result = $since_start->y . 'A';
            }
        }
 
        return $result;
    }

}