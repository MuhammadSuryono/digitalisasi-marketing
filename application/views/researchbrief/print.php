<?php
$arrProfilePerusahaan = unserialize($company_profile['profil_perusahaan']);
$arrQuestionProfilePerusahaan = [];
$arrAnswerProfilePerusahaan = [];
for ($i = 0; $i < count((is_countable($arrProfilePerusahaan) ? $arrProfilePerusahaan : [])); $i++) {
    if ($i % 2 == 0) {
        array_push($arrQuestionProfilePerusahaan, $arrProfilePerusahaan[$i]);
    } else {
        if (strpos($arrProfilePerusahaan[$i], '&bull;') !== false) {
            $arrString = explode('&bull;', $arrProfilePerusahaan[$i]);
            $arrString = array_diff($arrString, ['']);
            $arrStringNew = [];
            foreach ($arrString as $as) {
                array_push($arrStringNew, $as);
            }

            if (count($arrStringNew) == 1) {
                array_push($arrAnswerProfilePerusahaan, $arrStringNew[0]);
            } else {
                $string = '';
                for ($j = 0; $j < count($arrStringNew); $j++) {
                    if ($j == 0) {
                        $string .= "&bull;" . $arrStringNew[$j];
                    } else {
                        $string .=  "<br>&bull;" . $arrStringNew[$j];
                    }
                }
                array_push($arrAnswerProfilePerusahaan, $string);
            }
        } else {
            array_push($arrAnswerProfilePerusahaan, $arrProfilePerusahaan[$i]);
        }
    }
}

$arrLatarBelakangResearch = unserialize($research_brief['latar_belakang_research']);
$arrQuestionLatarBelakangResearch = [];
$arrAnswerLatarBelakangResearch = [];
for ($i = 0; $i < count($arrLatarBelakangResearch); $i++) {
    if ($i % 2 == 0) {
        array_push($arrQuestionLatarBelakangResearch, $arrLatarBelakangResearch[$i]);
    } else {
        if (strpos($arrLatarBelakangResearch[$i], '&bull;') !== false) {
            $arrString = explode('&bull;', $arrLatarBelakangResearch[$i]);
            $arrString = array_diff($arrString, ['']);
            $arrStringNew = [];
            foreach ($arrString as $as) {
                array_push($arrStringNew, $as);
            }

            if (count($arrStringNew) == 1) {
                array_push($arrAnswerLatarBelakangResearch, $arrStringNew[0]);
            } else {
                $string = '';
                for ($j = 0; $j < count($arrStringNew); $j++) {
                    if ($j == 0) {
                        $string .= "&bull;" . $arrStringNew[$j];
                    } else {
                        $string .=  "<br>&bull;" . $arrStringNew[$j];
                    }
                }
                array_push($arrAnswerLatarBelakangResearch, $string);
            }
        } else {
            array_push($arrAnswerLatarBelakangResearch, $arrLatarBelakangResearch[$i]);
        }
    }
}

$arrMethodology = unserialize($research_brief['methodology']);
$arrQuestionMethodology = [];
$arrAnswerMethodology = [];
for ($i = 0; $i < count($arrMethodology); $i++) {
    if ($i % 2 == 0) {
        array_push($arrQuestionMethodology, $arrMethodology[$i]);
    } else {
        if (strpos($arrMethodology[$i], '&bull;') !== false) {
            $arrString = explode('&bull;', $arrMethodology[$i]);
            $arrString = array_diff($arrString, ['']);
            $arrStringNew = [];
            foreach ($arrString as $as) {
                array_push($arrStringNew, $as);
            }

            if (count($arrStringNew) == 1) {
                array_push($arrAnswerMethodology, $arrStringNew[0]);
            } else {
                $string = '';
                for ($j = 0; $j < count($arrStringNew); $j++) {
                    if ($j == 0) {
                        $string .= "&bull;" . $arrStringNew[$j];
                    } else {
                        $string .=  "<br>&bull;" . $arrStringNew[$j];
                    }
                }
                array_push($arrAnswerMethodology, $string);
            }
        } else {
            array_push($arrAnswerMethodology, $arrMethodology[$i]);
        }
    }
}

$arrSamplingResponden = unserialize($research_brief['sampling_dan_responden']);
$arrQuestionSamplingResponden = [];
$arrAnswerSamplingResponden = [];
for ($i = 0; $i < count($arrSamplingResponden); $i++) {
    if ($i % 2 == 0) {
        array_push($arrQuestionSamplingResponden, $arrSamplingResponden[$i]);
    } else {
        if (strpos($arrSamplingResponden[$i], '&bull;') !== false) {
            $arrString = explode('&bull;', $arrSamplingResponden[$i]);
            $arrString = array_diff($arrString, ['']);
            $arrStringNew = [];
            foreach ($arrString as $as) {
                array_push($arrStringNew, $as);
            }

            if (count($arrStringNew) == 1) {
                array_push($arrAnswerSamplingResponden, $arrStringNew[0]);
            } else {
                $string = '';
                for ($j = 0; $j < count($arrStringNew); $j++) {
                    if ($j == 0) {
                        $string .= "&bull;" . $arrStringNew[$j];
                    } else {
                        $string .=  "<br>&bull;" . $arrStringNew[$j];
                    }
                }
                array_push($arrAnswerSamplingResponden, $string);
            }
        } else {
            array_push($arrAnswerSamplingResponden, $arrSamplingResponden[$i]);
        }
    }
}

// $arrDistribusiSampling = unserialize($research_brief['distribusi_sampling']);
// $arrQuestionDistribusiSampling = [];
// $arrAnswerDistribusiSampling = [];
// for ($i = 0; $i < count($arrDistribusiSampling); $i++) {
//     if ($i % 2 == 0) {
//         array_push($arrQuestionDistribusiSampling, $arrDistribusiSampling[$i]);
//     } else {
//         if (strpos($arrDistribusiSampling[$i], '&bull;') !== false) {
//             $arrString = explode('&bull;', $arrDistribusiSampling[$i]);
//             $arrString = array_diff($arrString, ['']);
//             $arrStringNew = [];
//             foreach ($arrString as $as) {
//                 array_push($arrStringNew, $as);
//             }

//             if (count($arrStringNew) == 1) {
//                 array_push($arrAnswerDistribusiSampling, $arrStringNew[0]);
//             } else {
//                 $string = '';
//                 for ($j = 0; $j < count($arrStringNew); $j++) {
//                     if ($j == 0) {
//                         $string .= "&bull;" . $arrStringNew[$j];
//                     } else {
//                         $string .=  "<br>&bull;" . $arrStringNew[$j];
//                     }
//                 }
//                 array_push($arrAnswerDistribusiSampling, $string);
//             }
//         } else {
//             array_push($arrAnswerDistribusiSampling, $arrDistribusiSampling[$i]);
//         }
//     }
// }

$arrTimeline = unserialize($research_brief['timeline']);
$arrQuestionTimeline = [];
$arrAnswerTimeline = [];
for ($i = 0; $i < count($arrTimeline); $i++) {
    if ($i % 2 == 0) {
        array_push($arrQuestionTimeline, $arrTimeline[$i]);
    } else {
        if (strpos($arrTimeline[$i], '&bull;') !== false) {
            $arrString = explode('&bull;', $arrTimeline[$i]);
            $arrString = array_diff($arrString, ['']);
            $arrStringNew = [];
            foreach ($arrString as $as) {
                array_push($arrStringNew, $as);
            }

            if (count($arrStringNew) == 1) {
                array_push($arrAnswerTimeline, $arrStringNew[0]);
            } else {
                $string = '';
                for ($j = 0; $j < count($arrStringNew); $j++) {
                    if ($j == 0) {
                        $string .= "&bull;" . $arrStringNew[$j];
                    } else {
                        $string .=  "<br>&bull;" . $arrStringNew[$j];
                    }
                }
                array_push($arrAnswerTimeline, $string);
            }
        } else {
            array_push($arrAnswerTimeline, $arrTimeline[$i]);
        }
    }
}

$arrBudget = unserialize($research_brief['budget']);
$arrQuestionBudget = [];
$arrAnswerBudget = [];
for ($i = 0; $i < count($arrBudget); $i++) {
    if ($i % 2 == 0) {
        array_push($arrQuestionBudget, $arrBudget[$i]);
    } else {
        if (strpos($arrBudget[$i], '&bull;') !== false) {
            $arrString = explode('&bull;', $arrBudget[$i]);
            $arrString = array_diff($arrString, ['']);
            $arrStringNew = [];
            foreach ($arrString as $as) {
                array_push($arrStringNew, $as);
            }

            if (count($arrStringNew) == 1) {
                array_push($arrAnswerBudget, $arrStringNew[0]);
            } else {
                $string = '';
                for ($j = 0; $j < count($arrStringNew); $j++) {
                    if ($j == 0) {
                        $string .= "&bull;" . $arrStringNew[$j];
                    } else {
                        $string .=  "<br>&bull;" . $arrStringNew[$j];
                    }
                }
                array_push($arrAnswerBudget, $string);
            }
        } else {
            array_push($arrAnswerBudget, $arrBudget[$i]);
        }
    }
}

$arrHalTeknis = unserialize($research_brief['hal_teknis_lainnya']);
$arrQuestionHalTeknis = [];
$arrAnswerHalTeknis = [];
for ($i = 0; $i < count($arrHalTeknis); $i++) {
    if ($i % 2 == 0) {
        array_push($arrQuestionHalTeknis, $arrHalTeknis[$i]);
    } else {
        if (strpos($arrHalTeknis[$i], '&bull;') !== false) {
            $arrString = explode('&bull;', $arrHalTeknis[$i]);
            $arrString = array_diff($arrString, ['']);
            $arrStringNew = [];
            foreach ($arrString as $as) {
                array_push($arrStringNew, $as);
            }

            if (count($arrStringNew) == 1) {
                array_push($arrAnswerHalTeknis, $arrStringNew[0]);
            } else {
                $string = '';
                for ($j = 0; $j < count($arrStringNew); $j++) {
                    if ($j == 0) {
                        $string .= "&bull;" . $arrStringNew[$j];
                    } else {
                        $string .=  "<br>&bull;" . $arrStringNew[$j];
                    }
                }
                array_push($arrAnswerHalTeknis, $string);
            }
        } else {
            array_push($arrAnswerHalTeknis, $arrHalTeknis[$i]);
        }
    }
}

$arrPeserta = unserialize($research_brief['peserta']);
$arrString = array_diff($arrPeserta, ['']);
$dataPeserta = [];
foreach ($arrString as $as) {
    array_push($dataPeserta, $as);
}

$pesaing = unserialize($research_brief['pesaing']);
$dataPesaing = [];
if (strpos($pesaing, '&bull;') !== false) {
    $arrString = explode('&bull;', $pesaing);
    $arrString = array_diff($arrString, ['']);
    $arrStringNew = [];
    foreach ($arrString as $as) {
        array_push($arrStringNew, $as);
    }

    if (count($arrStringNew) == 1) {
        array_push($dataPesaing, $arrStringNew[0]);
    } else {
        $string = '';
        for ($j = 0; $j < count($arrStringNew); $j++) {
            if ($j == 0) {
                $string .= "&bull;" . $arrStringNew[$j];
            } else {
                $string .=  "<br>&bull;" . $arrStringNew[$j];
            }
        }
        array_push($dataPesaing, $string);
    }
} else {
    array_push($dataPesaing, $pesaing);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .img {
            width: 100%;
            text-align: center;
        }

        .img img {
            width: 100px;
        }

        table#head {
            width: 100%;
            margin-bottom: 10px;
        }

        table#head tr td {
            text-align: center;
        }

        table#head tr td span {
            line-height: 2;
            font-weight: bold;
        }

        table#main {
            width: 100%;
        }

        table#main thead tr th {
            text-align: center;
        }

        table#main,
        table#main th,
        table#main td {
            border: 1px solid black;
            border-collapse: collapse;
        }

        .bag {
            width: 20%;
            text-align: center;
        }

        .quest {
            width: 40%;
            padding-right: 20px;
            text-align: justify;
            vertical-align: top;
        }

        .ans {
            width: 40%;
            padding-right: 20px;
            text-align: justify;
            vertical-align: top;
        }

        table#main tbody li {
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <div class="img">
        <img src="/var/www/html/dev-digital-market/assets/img/logomri.png" alt="">
    </div>
    <table id="head">
        <tr>
            <td>
                <span>Research Brief <br> <?= ($rfq) ? $rfq . '\\' : ''; ?><?= $research_brief['nama'] ?>\<?= $research_brief['nama_user'] ?></span>
            </td>
        </tr>
    </table>

    <table id="main">
        <thead>
            <tr>
                <th class="bag">Bagian</th>
                <th class="quest">Pertanyaan</th>
                <th class="ans">Isian</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th class="bag">Profile Perusahaan</th>
                <td class="quest">
                    <ol>
                        <?php foreach ($arrQuestionProfilePerusahaan as $data) : ?>
                            <li><?= $data ?></li>
                        <?php endforeach; ?>
                    </ol>
                </td>
                <td class="ans">
                    <ol>
                        <?php foreach ($arrAnswerProfilePerusahaan as $data) : ?>
                            <li><?= $data ?></li>
                        <?php endforeach; ?>
                    </ol>
                </td>
            </tr>
            <tr>
                <th class="bag">Latar Belakang Research</th>
                <td class="quest">
                    <ol>
                        <?php foreach ($arrQuestionLatarBelakangResearch as $data) : ?>
                            <li><?= $data ?></li>
                        <?php endforeach; ?>
                    </ol>
                </td>
                <td class="ans">
                    <ol>
                        <?php foreach ($arrAnswerLatarBelakangResearch as $data) : ?>
                            <li><?= $data ?></li>
                        <?php endforeach; ?>
                    </ol>
                </td>
            </tr>
            <tr>
                <th class="bag">Methodology</th>
                <td class="quest">
                    <ol>
                        <?php foreach ($arrQuestionMethodology as $data) : ?>
                            <li><?= $data ?></li>
                        <?php endforeach; ?>
                    </ol>
                </td>
                <td class="ans">
                    <ol>
                        <?php foreach ($arrAnswerMethodology as $data) : ?>
                            <li><?= $data ?></li>
                        <?php endforeach; ?>
                    </ol>
                </td>
            </tr>
            <tr>
                <th class="bag">Sampling dan Responden</th>
                <td class="quest">
                    <ol>
                        <?php foreach ($arrQuestionSamplingResponden as $data) : ?>
                            <li><?= $data ?></li>
                        <?php endforeach; ?>
                    </ol>
                </td>
                <td class="ans">
                    <ol>
                        <?php foreach ($arrAnswerSamplingResponden as $data) : ?>
                            <li><?= $data ?></li>
                        <?php endforeach; ?>
                    </ol>
                </td>
            </tr>
            <!-- <tr>
                <th class="bag">Distribusi Sampling</th>
                <td class="quest">
                    <ol>
                        <?php foreach ($arrQuestionDistribusiSampling as $data) : ?>
                            <li><?= $data ?></li>
                        <?php endforeach; ?>
                    </ol>
                </td>
                <td class="ans">
                    <ol>
                        <?php foreach ($arrAnswerDistribusiSampling as $data) : ?>
                            <li><?= $data ?></li>
                        <?php endforeach; ?>
                    </ol>
                </td>
            </tr> -->
            <tr>
                <th class="bag">Budget</th>
                <td class="quest">
                    <ol>
                        <?php foreach ($arrQuestionBudget as $data) : ?>
                            <li><?= $data ?></li>
                        <?php endforeach; ?>
                    </ol>
                </td>
                <td class="ans">
                    <ol>
                        <?php foreach ($arrAnswerBudget as $data) : ?>
                            <li><?= $data ?></li>
                        <?php endforeach; ?>
                    </ol>
                </td>
            </tr>
            <tr>
                <th class="bag">Hal Teknis Lainnya</th>
                <td class="quest">
                    <ol>
                        <?php foreach ($arrQuestionHalTeknis as $data) : ?>
                            <li><?= $data ?></li>
                        <?php endforeach; ?>
                    </ol>
                </td>
                <td class="ans">
                    <ol>
                        <?php foreach ($arrAnswerHalTeknis as $data) : ?>
                            <li><?= $data ?></li>
                        <?php endforeach; ?>
                    </ol>
                </td>
            </tr>
            <tr>
                <th class="bag">Perwakilan MRI & Perusahaan Pesaing</th>
                <td class="quest">
                    <ol>
                        <li>Perwakilan MRI</li>
                        <li>Perusahaan Pesaing</li>
                    </ol>
                </td>
                <td class="ans">
                    <ol>
                        <li>
                            <?php
                            foreach ($dataPeserta as $data) :
                                $data = (int)$data;
                                $nama = $this->db->query("SELECT nama_user FROM data_user WHERE id_user = $data")->row_array();
                            ?>
                                &bull; <?= $nama['nama_user'] ?><br>

                            <?php
                            endforeach;

                            ?>
                        </li>
                        <?php foreach ($dataPesaing as $data) :
                        ?>
                            <li><?= $data ?></li>
                        <?php endforeach; ?>
                    </ol>
                </td>
            </tr>
        </tbody>
    </table>
</body>

</html>