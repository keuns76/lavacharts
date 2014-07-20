<?php namespace Khill\Lavacharts\Charts;

/**
 * Column Chart Class
 *
 * A vertical bar chart that is rendered within the browser using SVG or VML.
 * Displays tips when hovering over bars. For a horizontal version of this
 * chart, see the Bar Chart.
 *
 *
 * @category  Class
 * @package   Khill\Lavacharts\Charts
 * @author    Kevin Hill <kevinkhill@gmail.com>
 * @copyright (c) 2014, KHill Designs
 * @link      https://github.com/kevinkhill/LavaCharts GitHub Repository Page
 * @link      http://kevinkhill.github.io/LavaCharts/ GitHub Project Page
 * @license   http://www.gnu.org/licenses/MIT MIT
 */

use Khill\Lavacharts\Helpers\Helpers;
use Khill\Lavacharts\Configs\HorizontalAxis;
use Khill\Lavacharts\Configs\VerticalAxis;

class ColumnChart extends Chart
{
    public $type = 'ColumnChart';

    public function __construct($chartLabel)
    {
        parent::__construct($chartLabel);

        $this->defaults = array_merge(
            $this->defaults,
            array(
            //                'animation',
                'axisTitlesPosition',
                'barGroupWidth',
                'focusTarget',
                'hAxis',
                'isHtml',
            //                'vAxes',
                'vAxis'
            )
        );
    }

    /**
     * Where to place the axis titles, compared to the chart area. Supported values:
     * in - Draw the axis titles inside the the chart area.
     * out - Draw the axis titles outside the chart area.
     * none - Omit the axis titles.
     *
     * @param string $position
     * @return Khill\Lavacharts\Charts\ColumnChart
     */
    public function axisTitlesPosition($position)
    {
        $values = array(
            'in',
            'out',
            'none'
        );

        if (is_string($position) && in_array($position, $values)) {
            $this->addOption(array('axisTitlesPosition' => $position));
        } else {
            throw $this->invalidConfigValue(
                __FUNCTION__,
                'string',
                'with a value of '.Helpers::arrayToPipedString($values)
            );
        }

        return $this;
    }

    /**
     * The width of a group of bars, specified in either of these formats:
     * - Pixels (e.g. 50).
     * - Percentage of the available width for each group (e.g. '20%'),
     *   where '100%' means that groups have no space between them.
     *
     * @param mixed $barGroupWidth
     * @return Khill\Lavacharts\Charts\ColumnChart
     */
    public function barGroupWidth($barGroupWidth)
    {
        if (Helpers::isIntOrPercent($barGroupWidth)) {
            $this->addOption(array('bar' => array('groupWidth' => $barGroupWidth)));
        } else {
            throw $this->invalidConfigValue(
                __FUNCTION__,
                'string | int',
                'must be a valid int or percent [ 50 | 65% ]'
            );
        }

        return $this;
    }


    /**
     * An object with members to configure various horizontal axis elements. To
     * specify properties of this property, create a new hAxis() object, set
     * the values then pass it to this function or to the constructor.
     *
     * @param  Khill\Lavacharts\Configs\HorizontalAxis $hAxis
     * @throws Khill\Lavacharts\Exceptions\InvalidConfigValue
     * @return Khill\Lavacharts\Charts\ColumnChart
     */
    public function hAxis(HorizontalAxis $hAxis)
    {
        $this->addOption($hAxis->toArray('hAxis'));
 
        return $this;
    }

    /**
     * If set to true, series elements are stacked.
     *
     * @param boolean $isStacked
     * @return Khill\Lavacharts\Charts\ColumnChart
     */
    public function isStacked($isStacked)
    {
        if (is_bool($isStacked)) {
            $this->addOption(array('isStacked' => $isStacked));
        } else {
            throw $this->invalidConfigValue(
                __FUNCTION__,
                'boolean'
            );
        }

        return $this;
    }

    /**
     * An object with members to configure various vertical axis elements. To
     * specify properties of this property, create a new vAxis() object, set
     * the values then pass it to this function or to the constructor.
     *
     * @param  Khill\Lavacharts\Configs\VerticalAxis $vAxis
     * @throws Khill\Lavacharts\Exceptions\InvalidConfigValue
     * @return Khill\Lavacharts\Charts\ColumnChart
     */
    public function vAxis(VerticalAxis $vAxis)
    {
        $this->addOption($vAxis->toArray('vAxis'));
 
        return $this;
    }
}
