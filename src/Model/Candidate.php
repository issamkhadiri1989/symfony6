<?php

declare(strict_types=1);

namespace App\Model;

use Symfony\Component\Validator\Constraints as Assert;

class Candidate
{
    /**
     * A name should not be empty and not be null.
     *
     * @Assert\NotNull()
     * @Assert\NotBlank()
     */
    private string $fullName;

    /**
     * All entries of this array must be a valid email and not empty.
     *
     * @Assert\All({
     *      @Assert\Email(),
     *      @Assert\NotBlank()
     * })
     */
    private array $emails;

    /**
     * The favorite colors should be a unique entry in the $favoriteColors array and each color must be:
     * in short hex, log hex, basic named color and extended named color as a css color.
     *
     * @example "#CCC, red, cian, #EEEEEE"
     *
     * @Assert\Unique()
     * @Assert\All({
     *      @Assert\NotBlank,
     *      @Assert\CssColor({
     *          formats={
     *              Assert\CssColor::BASIC_NAMED_COLORS,
     *              Assert\CssColor::EXTENDED_NAMED_COLORS,
     *              Assert\CssColor::HEX_SHORT,
     *              Assert\CssColor::HEX_LONG,
     *          }
     *     })
     * })
     */
    private array $favoriteColors;

    /**
     * This is the level of communication. 100% Perfect and 0% too bad.
     *
     * @Assert\Range(max="100", min="0")
     */
    private int $communicationLevel;
}
