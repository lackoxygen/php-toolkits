<?php

namespace Lackoxygen\Toolkits;

class BC
{
    /**
     * Returns the function calculated based on the passed in.
     *
     * @param callable $callback
     * @param array $nums
     * @param int $scale
     * @return float|int|string
     */
    public static function sum(
        callable $callback,
        array    $nums = [],
        int      $scale = 0): string
    {
        if (count($nums) === 0) {
            return 0;
        }

        if ($scale == 0) {
            $scale = ini_get('precision');
        }

        $sum = (string)array_shift($nums);

        foreach ($nums as $num) {
            $sum = $callback($num, (string)$num, $scale);
        }

        return (string)$sum;
    }

    /**
     * Returns an array of arrays and ignores 0 values.
     *
     * @param array $argv
     * @param int $scale
     *
     * @return int|string
     *
     */
    public static function add(array $argv = [], int $scale = 0): string
    {
        return self::sum('bcadd', $argv, $scale);
    }

    /**
     * Returns array division, ignoring 0 values.
     *
     * @param array $nums
     * @param int|null $scale
     *
     * @return int|string
     */
    public static function div(array $nums = [], int $scale = 0): string
    {
        $i = 0;
        $nums = array_filter($nums, function ($v) use (&$i) {
            if ($i > 0) {
                return $v !== 0;
            }
            return ++$i;
        });

        return self::sum('bcdiv', $nums, $scale);
    }


    /**
     * Return `$left` to find the modulus.
     *
     * @param $left
     * @param $model
     * @param int|null $scale
     *
     * @return int|string
     */
    public static function mod($left, $model, int $scale = 2): string
    {
        return self::sum('bcmod', [$left, $model], $scale);
    }


    /**
     * Return the numbers in the array to multiply.
     *
     * @param array $argv
     * @param int|null $scale
     *
     * @return int|string
     *
     */
    public static function mul(array $argv = [], int $scale = 2): string
    {
        return self::sum('bcmul', $argv, $scale);
    }

    /**
     * Return the numbers in the array for subtraction.
     *
     * @param array $mums
     * @param int|null $scale
     *
     * @return int|string
     */
    public static function sub(array $mums = [], int $scale = 2)
    {
        return self::sum('bcsub', $mums, $scale);
    }

    /**
     * Compare `$left` with `$right`
     *
     * @param $left
     * @param $right
     * @param int|null $scale
     * @return int
     */
    public static function cmp($left, $right, int $scale = null): int
    {
        if (is_null($scale)) {
            $scale = max(strlen(self::precision($left)), strlen(self::precision($right)));
        }
        return bccomp($left, $right, $scale);
    }

    /**
     * `$left` equals `$right`
     *
     * @param $left
     * @param $right
     * @param int|null $scale
     * @return bool
     */
    public static function equal($left, $right, int $scale = 0): bool
    {
        return 0 === self::cmp(...func_get_args());
    }

    /**
     * `$left` is less than `$right`
     *
     * @param $left
     * @param $right
     * @param int|null $scale
     * @return bool
     */
    public static function less($left, $right, int $scale = 0): bool
    {
        return 1 === self::cmp(...func_get_args());
    }

    /**
     * `$left` is bigger than $right
     *
     * @param $left
     * @param $right
     * @param int|null $scale
     * @return bool
     */
    public static function greater($left, $right, int $scale = 0): bool
    {
        return -1 === self::cmp(...func_get_args());
    }

    /**
     * Returns the number of decimal places in a floating point.
     *
     * @param $decimal
     * @return string
     */
    public static function precision($decimal): string
    {
        $parts = explode('.', $decimal);

        return (string)Arr::get($parts, 1, '');
    }
}
